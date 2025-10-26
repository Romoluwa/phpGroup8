<!-- login.php -->
<?php
include 'db.php';
session_start();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $res = $conn->query("SELECT * FROM voters WHERE username='$username' AND password='$password'");
    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        $_SESSION['voter_id'] = $user['id'];
        $_SESSION['voter_last'] = $user['last_name'];
        header("Location: vote.php");
    } else {
        $msg = "Invalid login credentials!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login - Online Voting</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container fade-in">
    <h2>Voter Login</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Login</button>
    </form>
    <p><?php echo $msg; ?></p>
    <a href="register.php">Don’t have an account? Register</a>
  </div>
  <script src="script.js"></script>
</body>
</html>