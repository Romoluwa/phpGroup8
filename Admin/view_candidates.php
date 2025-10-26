<?php
// admin/view_candidates.php
session_start();
require_once __DIR__ . '/../db.php';
if (!isset($_SESSION['admin_user'])) {
    header("Location: admin_login.php");
    exit();
}

$position_id = isset($_GET['position_id']) ? intval($_GET['position_id']) : 0;
$pos_res = $conn->query("SELECT * FROM positions WHERE id = $position_id LIMIT 1");
if (!$pos_res || $pos_res->num_rows === 0) {
    header("Location: dashboard.php");
    exit();
}
$pos = $pos_res->fetch_assoc();

// Delete candidate if requested
if (isset($_GET['delete_candidate'])) {
    $cid = intval($_GET['delete_candidate']);
    $conn->query("DELETE FROM candidates WHERE id = $cid");
    header("Location: view_candidates.php?position_id=$position_id");
    exit();
}

// Candidate list with vote counts
$cands = $conn->query("
    SELECT c.id, c.candidate_name, COUNT(v.id) AS votes
    FROM candidates c
    LEFT JOIN votes v ON v.candidate_id = c.id
    WHERE c.position_id = $position_id
    GROUP BY c.id
    ORDER BY votes DESC
");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Candidates - <?php echo htmlspecialchars($pos['position_name']); ?></title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="nav"><a href="dashboard.php">← Back</a></div>
  <div class="container fade-in">
    <h2>Candidates for: <?php echo htmlspecialchars($pos['position_name']); ?></h2>
    <table>
      <tr><th>Candidate</th><th>Votes</th><th>Action</th></tr>
      <?php while ($c = $cands->fetch_assoc()): ?>
        <tr>
          <td><?php echo htmlspecialchars($c['candidate_name']); ?></td>
          <td><?php echo intval($c['votes']); ?></td>
          <td>
            <a href="view_candidates.php?position_id=<?php echo $position_id; ?>&delete_candidate=<?php echo $c['id']; ?>"
               onclick="return confirm('Delete this candidate?');">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
<script src="../script.js"></script>
</body>
</html>
