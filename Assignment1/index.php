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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online voting system</title>
<link href="/Assignment1/CSS/style.css" rel="stylesheet">

    <!-- Bootstrap css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="bg-primary ">
 <p class="text-primary text-center p-3 fs-2 fw-semibold bg-dark">Welcome To Babcock's Voting Portal!</p>
<div class="bg-primary w-full py-4">
    <p class="text-dark text-center p-2 fs-3 fw-semibold">Login Page</p>
    <div class="container text-center">
        <form action="">
            <div class="mb-3 d-flex flex-row">
                <!-- <label for="" class="form-label text-light">First Name</label> -->
                <input type="text" name="firstname" placeholder="Enter your first name" class="form-control w-50 m-auto">
            </div>
            <div class="mb-3 d-flex flex-row">
                <!-- <label for="" class="form-label text-light">Last Name</label> -->
                <input type="text" name="lastname" placeholder="Enter your last name" class="form-control w-50 m-auto">
            </div>
            <div class="mb-3 d-flex flex-row">
                <!-- <label for="" class="form-label text-light">Matric Number</label> -->
                <input type="number" name="matricno" placeholder="e.g., AB20/00123" class="form-control w-50 m-auto">
            </div>
            <div class="mb-3 d-flex flex-row">
                <!-- <label for="" class="form-label text-light">Matric Number</label> -->
                <input type="password" name="password" placeholder="Enter your password" class="form-control w-50 m-auto">
            </div>
            <div class="mb-3">
                <select name="std" id="" class="form-select w-50 m-auto">
                    <option value="candidate">Candidate</option>
                    <option value="voter">Voter</option>
                </select>
            </div>
            <button type="submit" class="btn btn-outline-info btn-dark text-light my-4">Login</button>
            <p class="">Don't have an account?<a href="registration.php" class="text-white">Register here</a></p>
            
        </form>
    </div> 
</div>
</body >
</html>