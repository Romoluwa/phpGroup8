<?php
// admin/admin_login.php
session_start();
require_once __DIR__ . '/../db.php';

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = md5(trim($_POST['password']));

    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password' LIMIT 1";
    $res = $conn->query($sql);
    if ($res && $res->num_rows === 1) {
        $_SESSION['admin_user'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $msg = "Invalid admin credentials.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin Login - Voting System</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="container fade-in">
    <h2>Admin Login</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Login</button>
    </form>
    <?php if ($msg) {
        echo "<p class='error'>{$msg}</p>";
    } ?>
    <p><a href="../login.php">Back to Voter Login</a></p>
  </div>
  <script src="../script.js"></script>
</body>
</html>
