<?php
// admin/dashboard.php
session_start();
require_once __DIR__ . '/../db.php';
if (!isset($_SESSION['admin_user'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle position delete (and cascade to candidates via FK)
if (isset($_GET['delete_position'])) {
    $pos_id = intval($_GET['delete_position']);
    $conn->query("DELETE FROM positions WHERE id = $pos_id");
    header("Location: dashboard.php");
    exit();
}

// Handle candidate delete
if (isset($_GET['delete_candidate'])) {
    $cand_id = intval($_GET['delete_candidate']);
    $conn->query("DELETE FROM candidates WHERE id = $cand_id");
    header("Location: dashboard.php");
    exit();
}

// Totals
$total_voters = $conn->query("SELECT COUNT(*) AS c FROM voters")->fetch_assoc()['c'];
$total_positions = $conn->query("SELECT COUNT(*) AS c FROM positions")->fetch_assoc()['c'];
$total_votes = $conn->query("SELECT COUNT(*) AS c FROM votes")->fetch_assoc()['c'];

$positions = $conn->query("SELECT * FROM positions ORDER BY id ASC");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin Dashboard - Voting System</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    .stats { display:flex; gap:12px; justify-content:center; margin-bottom:16px; }
    .stat-card { background: rgba(255,255,255,0.02); padding:12px 16px; border-radius:10px; min-width:120px; }
    .small-action { font-size:13px; color:#00eaff; margin-left:8px; }
    .pos-list { text-align:left; margin-top:12px; }
    .pos-item { padding:10px; border-bottom:1px solid rgba(255,255,255,0.03); display:flex; justify-content:space-between; align-items:center; }
    .pos-links a { margin-left:8px; text-decoration:none; color:#00eaff; }
  </style>
</head>
<body>
  <div class="nav">
    <h3>Admin Panel</h3>
    <div>
      <strong><?php echo htmlspecialchars($_SESSION['admin_user']); ?></strong>
      <a href="logout.php"><button class="logout-btn">Logout</button></a>
    </div>
  </div>

  <div class="container fade-in">
    <h2>Dashboard</h2>
    <div class="stats">
      <div class="stat-card"><strong><?php echo $total_voters; ?></strong><div>Voters</div></div>
      <div class="stat-card"><strong><?php echo $total_positions; ?></strong><div>Positions</div></div>
      <div class="stat-card"><strong><?php echo $total_votes; ?></strong><div>Total Votes</div></div>
    </div>

    <div style="margin-bottom:12px;">
      <a href="add_position.php"><button>Add Position</button></a>
      <a href="add_candidate.php"><button>Add Candidate</button></a>
      <a href="view_votes.php"><button>View Results</button></a>
    </div>

    <div class="pos-list">
      <h3 style="margin-bottom:8px;">Positions</h3>
      <?php while ($p = $positions->fetch_assoc()): ?>
        <div class="pos-item">
          <div>
            <strong><?php echo htmlspecialchars($p['position_name']); ?></strong>
            <span class="small-action">(#<?php echo $p['id']; ?>)</span>
          </div>
          <div class="pos-links">
            <a href="view_candidates.php?position_id=<?php echo $p['id']; ?>">View Candidates</a>
            <a href="dashboard.php?delete_position=<?php echo $p['id']; ?>" onclick="return confirm('Delete position and its candidates?');">Delete</a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

    <hr style="margin:18px 0; border-color: rgba(255,255,255,0.06);">

    <h3>All Candidates (quick list)</h3>
    <table>
      <tr><th>Candidate</th><th>Position</th><th>Action</th></tr>
      <?php
      $list = $conn->query("SELECT candidates.id AS cid, candidates.candidate_name, positions.position_name FROM candidates LEFT JOIN positions ON candidates.position_id = positions.id ORDER BY positions.position_name ASC");
while ($r = $list->fetch_assoc()):
    ?>
      <tr>
        <td><?php echo htmlspecialchars($r['candidate_name']); ?></td>
        <td><?php echo htmlspecialchars($r['position_name']); ?></td>
        <td>
          <a href="dashboard.php?delete_candidate=<?php echo $r['cid']; ?>" onclick="return confirm('Delete this candidate?');">Delete</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>

<script src="../script.js"></script>
</body>
</html>
