<?php
// admin/view_votes.php
session_start();
require_once __DIR__ . '/../db.php';
if (!isset($_SESSION['admin_user'])) {
    header("Location: admin_login.php");
    exit();
}

$positions = $conn->query("SELECT * FROM positions ORDER BY position_name ASC");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>View Votes - Admin</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="nav"><a href="dashboard.php">← Back</a></div>
  <div class="container fade-in">
    <h2>Voting Results (Admin)</h2>
    <?php while ($pos = $positions->fetch_assoc()): ?>
      <h3><?php echo htmlspecialchars($pos['position_name']); ?></h3>
      <?php
        $q = $conn->query("
          SELECT c.candidate_name, COUNT(v.id) AS total_votes
          FROM candidates c
          LEFT JOIN votes v ON v.candidate_id = c.id
          WHERE c.position_id = {$pos['id']}
          GROUP BY c.id
          ORDER BY total_votes DESC
        ");
        ?>
      <table>
        <tr><th>Candidate</th><th>Votes</th></tr>
        <?php while ($r = $q->fetch_assoc()): ?>
          <tr><td><?php echo htmlspecialchars($r['candidate_name']); ?></td><td><?php echo intval($r['total_votes']); ?></td></tr>
        <?php endwhile; ?>
      </table>
      <hr style="border-color: rgba(255,255,255,0.06);">
    <?php endwhile; ?>
  </div>
<script src="../script.js"></script>
</body>
</html>
