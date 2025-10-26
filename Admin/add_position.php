<?php
// admin/add_position.php
session_start();
require_once __DIR__ . '/../db.php';
if (!isset($_SESSION['admin_user'])) {
    header("Location: admin_login.php");
    exit();
}
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pos = $conn->real_escape_string(trim($_POST['position_name']));
    if ($pos !== '') {
        $conn->query("INSERT INTO positions (position_name) VALUES ('$pos')");
        $msg = "Position added.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Position</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="nav"><a href="dashboard.php">← Back</a></div>
  <div class="container fade-in">
    <h2>Add Position</h2>
    <form method="POST">
      <input type="text" name="position_name" placeholder="e.g. President" required><br>
      <button type="submit">Add Position</button>
    </form>
    <p><?php echo $msg; ?></p>
  </div>
<script src="../script.js"></script>
</body>
</html>
