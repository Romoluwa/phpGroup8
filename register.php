<!-- REGISTER.PHP -->
<?php
include 'db.php';
$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $check = $conn->query("SELECT * FROM voters WHERE username='$username'");
    if ($check->num_rows > 0) {
        $msg = "Username already exists!";
    } else {
        $sql = "INSERT INTO voters (first_name, last_name, username, password) VALUES ('$first', '$last', '$username', '$password')";
        if ($conn->query($sql)) {
            $msg = "✅ Registration successful! You can now log in.";
        } else {
            $msg = "❌ Registration failed.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register - Online Voting</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container fade-in">
    <h2>Voter Registration</h2>
    <form method="POST">
      <input type="text" name="first_name" placeholder="First Name" required><br>
      <input type="text" name="last_name" placeholder="Last Name" required><br>
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Register</button>
    </form>
    <p><?php echo $msg; ?></p>
    <a href="login.php">Already have an account? Login</a>
  </div>
  <script src="script.js"></script>
</body>
</html>