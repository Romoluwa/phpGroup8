<!-- Results.php -->
<?php
include 'db.php';
session_start();
if (!isset($_SESSION['voter_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Results - Online Voting</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="nav">
    <a href="vote.php">← Back</a>
    <a href="logout.php">Logout</a>
  </div>

  <div class="container fade-in">
    <h2>Live Voting Results</h2>
    <?php
    $positions = $conn->query("SELECT * FROM positions");
while ($pos = $positions->fetch_assoc()) {
    echo "<h3>{$pos['position_name']}</h3>";
    $cand = $conn->query("
          SELECT candidates.candidate_name, COUNT(votes.id) AS total_votes
          FROM candidates
          LEFT JOIN votes ON candidates.id = votes.candidate_id
          WHERE candidates.position_id = '{$pos['id']}'
          GROUP BY candidates.id
        ");
    echo "<table class='result-table'>
              <tr><th>Candidate</th><th>Votes</th></tr>";
    while ($row = $cand->fetch_assoc()) {
        echo "<tr><td>{$row['candidate_name']}</td><td>{$row['total_votes']}</td></tr>";
    }
    echo "</table><hr>";
}
?>
  </div>
  <script src="script.js"></script>
</body>
</html>