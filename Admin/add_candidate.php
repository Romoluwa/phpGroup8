<?php
// admin/add_candidate.php
session_start();
require_once __DIR__ . '/../db.php';
if (!isset($_SESSION['admin_user'])) {
    header("Location: admin_login.php");
    exit();
}

$msg = '';
$positions = $conn->query("SELECT * FROM positions ORDER BY position_name ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string(trim($_POST['candidate_name']));
    $position_id = intval($_POST['position_id']);
    if ($name !== '' && $position_id > 0) {
        $conn->query("INSERT INTO candidates (candidate_name, position_id) VALUES ('$name', $position_id)");
        $msg = "Candidate added.";
    } else {
        $msg = "Please provide a name and select a position.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Candidate</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="nav"><a href="dashboard.php">← Back</a></div>
  <div class="container fade-in">
    <h2>Add Candidate</h2>
    <form method="POST">
      <input type="text" name="candidate_name" placeholder="Candidate Full Name" required><br>
      <select name="position_id" required>
        <option value="">Select Position</option>
        <?php while ($p = $positions->fetch_assoc()): ?>
          <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['position_name']); ?></option>
        <?php endwhile; ?>
      </select><br>
      <button type="submit">Add Candidate</button>
    </form>
    <p><?php echo $msg; ?></p>
  </div>
<script src="../script.js"></script>
</body>
</html>
