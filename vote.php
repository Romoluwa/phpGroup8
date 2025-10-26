<!-- vote.php -->
<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['voter_id'])) {
    header("Location: login.php");
    exit();
}

$voter_id = intval($_SESSION['voter_id']);
$voter_last = isset($_SESSION['voter_last']) ? htmlspecialchars($_SESSION['voter_last']) : '';

// fetch positions
$positions_stmt = $conn->prepare("SELECT id, position_name FROM positions ORDER BY id ASC");
$positions_stmt->execute();
$positions_result = $positions_stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Vote - Online Voting</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Small additions for voted badge and messages */
    .badge-voted {
      display:inline-block;
      background: linear-gradient(90deg,#2ecc71,#27ae60);
      color: #001;
      padding: 6px 10px;
      border-radius: 12px;
      font-weight: 700;
      margin-left:10px;
      box-shadow: 0 0 12px rgba(46,204,113,0.15);
    }
    .vote-message {
      margin-top:10px;
      padding:10px;
      border-radius:8px;
      background: rgba(0,0,0,0.45);
      color: #00ffca;
      display:none;
    }
    .candidate { text-align:left; padding:6px 0; }
    .candidate input[type="radio"] { margin-right:10px; }
    .disabled-overlay {
      opacity: 0.5;
      pointer-events: none;
    }
  </style>
</head>
<body>
  <div class="nav">
    <h3>Welcome, <?php echo $voter_last; ?> 👋</h3>
    <a href="results.php">View Results</a>
    <a href="logout.php">Logout</a>
  </div>

  <div class="container fade-in">
    <h2>Vote for Your Candidates</h2>
    <div id="global-message" class="vote-message"></div>

    <?php while ($pos = $positions_result->fetch_assoc()):
        $position_id = intval($pos['id']);
        // check if the voter already voted for this position
        $chk_stmt = $conn->prepare("SELECT COUNT(*) AS c FROM votes WHERE voter_id = ? AND position_id = ?");
        $chk_stmt->bind_param("ii", $voter_id, $position_id);
        $chk_stmt->execute();
        $chk_res = $chk_stmt->get_result()->fetch_assoc();
        $has_voted = ($chk_res['c'] > 0);
        // fetch candidates for this position
        $cand_stmt = $conn->prepare("SELECT id, candidate_name FROM candidates WHERE position_id = ? ORDER BY id ASC");
        $cand_stmt->bind_param("i", $position_id);
        $cand_stmt->execute();
        $cand_res = $cand_stmt->get_result();
        ?>
      <section style="margin-bottom:20px;">
        <div style="display:flex; align-items:center; justify-content:space-between;">
          <h3 style="margin:0;"><?php echo htmlspecialchars($pos['position_name']); ?></h3>
          <?php if ($has_voted): ?>
            <span class="badge-voted">Voted</span>
          <?php endif; ?>
        </div>

        <?php if ($has_voted): ?>
          <!-- If voted: show candidates but disabled (to avoid confusion) -->
          <div class="disabled-overlay" style="padding-top:10px;">
            <?php while ($c = $cand_res->fetch_assoc()): ?>
              <div class="candidate">
                <label>
                  <input type="radio" disabled>
                  <?php echo htmlspecialchars($c['candidate_name']); ?>
                </label>
              </div>
            <?php endwhile; ?>
            <div style="margin-top:8px;color:#bbbbbb;font-size:14px;">You already voted for this position.</div>
          </div>
        <?php else: ?>
          <!-- Active form for voting this position -->
          <form class="vote-form" data-position-id="<?php echo $position_id; ?>">
            <?php while ($c = $cand_res->fetch_assoc()): ?>
              <div class="candidate">
                <label>
                  <input type="radio" name="candidate_id" value="<?php echo intval($c['id']); ?>" required>
                  <?php echo htmlspecialchars($c['candidate_name']); ?>
                </label>
              </div>
            <?php endwhile; ?>
            <input type="hidden" name="position_id" value="<?php echo $position_id; ?>">
            <button type="submit" name="vote">Submit Vote</button>
          </form>
        <?php endif; ?>

      </section>
    <?php
            $chk_stmt->close();
        $cand_stmt->close();
    endwhile;
$positions_stmt->close();
?>

  </div>

  <script src="script.js"></script>
  <script>
  // Handle AJAX voting per position with auto-reload on success
  (function(){
    const forms = document.querySelectorAll('.vote-form');
    const globalMsg = document.getElementById('global-message');

    forms.forEach(form => {
      form.addEventListener('submit', function(e){
        e.preventDefault();
        const fd = new FormData(form);
        // show immediate disabled state so user doesn't double click
        const btn = form.querySelector("button[name='vote']");
        btn.disabled = true;
        btn.textContent = 'Submitting...';

        fetch('submit_vote.php', {
          method: 'POST',
          body: fd,
        })
        .then(r => r.json())
        .then(data => {
          if (data.status === 'ok') {
            globalMsg.style.display = 'block';
            globalMsg.style.background = 'rgba(0,0,0,0.45)';
            globalMsg.textContent = '✅ Vote cast successfully! The page will refresh...';
            // small visual change on the form
            form.classList.add('disabled-overlay');
            // reload after 1.8s so UI updates to show Voted badge
            setTimeout(() => { location.reload(); }, 1800);
          } else if (data.status === 'already') {
            globalMsg.style.display = 'block';
            globalMsg.style.background = 'rgba(255,165,0,0.12)';
            globalMsg.textContent = '⚠ You already voted for this position.';
            setTimeout(() => { location.reload(); }, 1400);
          } else {
            globalMsg.style.display = 'block';
            globalMsg.style.background = 'rgba(255,0,0,0.12)';
            globalMsg.textContent = '❌ Error: ' + (data.message || 'Could not submit vote');
            btn.disabled = false;
            btn.textContent = 'Submit Vote';
          }
        })
        .catch(err => {
          globalMsg.style.display = 'block';
          globalMsg.style.background = 'rgba(255,0,0,0.12)';
          globalMsg.textContent = 'Network error. Please try again.';
          btn.disabled = false;
          btn.textContent = 'Submit Vote';
        });
      });
    });
  })();
  </script>
</body>
</html>