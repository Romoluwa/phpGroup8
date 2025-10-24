<!-- THIS PAGE IS FOR THE LOGIN PART -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Voting System - Login</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <div class="card">
      <h1>Welcome To Babcock’s Voting Portal</h1>
      <h3>Login to your account</h3>

      <form action="login.php" method="POST">
        <input type="text" name="firstname" placeholder="Enter your first name" required>
        <input type="text" name="lastname" placeholder="Enter your last name" required>
        <input type="text" name="matricno" placeholder="e.g., AB20/00123" required>
        <input type="password" name="password" placeholder="Enter your password" required>

        <select name="role" required>
          <option value="">Select Role</option>
          <option value="candidate">Candidate</option>
          <option value="voter">Voter</option>
        </select>

        <button type="submit" class="btn-primary">Login</button>
      </form>

      <p class="login-text">Don’t have an account? 
        <a href="registration.php">Register here</a>
      </p>
    </div>
  </div>
</body>
   
</html> 