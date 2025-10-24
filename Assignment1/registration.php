<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System - Registration</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Create Account</h1>
            <h3>Join the community to impact meaningfully in the society</h3>

            <form action="registration.php" method="POST">
                <input type="text" name="firstname" placeholder="Enter your Firstname" required>
                <input type="text" name="lastname" placeholder="Enter your Lastname" required>
                <input type="text" name="matricno" placeholder="Enter your Matric Number" required>
                <input type="password" name="password" placeholder="Enter a strong password" required>
                <input type="password" name="confirm_password" placeholder="Confirm password" required>

                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="V">Voter</option>
                    <option value="C">Candidate</option>
                </select>

                <button type="submit" class="btn-primary">Register</button>
            </form>

            <p class="login-text">
                Already have an account? <a href="index.php">Login</a>
            </p>
        </div>
</body>
</html>