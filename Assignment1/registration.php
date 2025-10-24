<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Voting system</title>
</head>

<body>
    <div class="main">
      <div class="reg">
        <h1>
     Create Account 
        </h1>
<h3>Join the community to impact meaningfully in the society</h3>
        <div class="cred">
          <form action="registration.php" method="POST">
            <p><label for="First name"></label>
                <input type="text" name="firstname" id="" placeholder ="Enter your Firstname">
            </p>
            <form action="registration.php" method="POST">
            <p><label for="Last name"></label>
                <input type="text" name="grade1" id="" placeholder="Enter your Lastname">
            </p>
      <form action="registration.php" method="POST">
            <p><label for="Matric number"></label>
                <input type="" name="matric number" id="" placeholder = "Enter your matric number">
            </p>
<form action="registration.php" method="POST">
            <p><label for="password"></label>
                <input type="password"  id="password" placeholder="Enter a strong password">
                 
            </p>
            <form action="registration.php" method="POST">
            <p><label for="password"></label>
                <input type="password"  id="password" placeholder="Confirm password">
                 
            </p>
          

       <label for="role"></label>
        <select id="role" name="role" required>
            <option value =""> Role </option>
            <option value="V">Voter</option>
            <option value="C">Candidate</option>
        </select><br><br>

            </div>
      <button type="submit" class="reg-btn" > <a href= "">Register</a>
        
      </button>
      <div class="login">
      <p>Already have an account?</p>
    </div>
    <a href="index.php">Login</a>
</div>
    </div>
</body>
</html>