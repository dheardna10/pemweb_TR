<?php
session_start();
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login & Signup Floslyy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="tr.css" />
  <script src="script.js" defer></script>
  <script>
    function toggleForm() {
      const loginForm = document.getElementById("loginForm");
      const signUpForm = document.getElementById("signUpForm");
      loginForm.classList.toggle("d-none");
      signUpForm.classList.toggle("d-none");
    }
  </script>
</head>
    
<body class="login-page">
  <div class="overlay"></div>
  <div class="form-container">
    <!-- Form Login -->
    <div id="loginForm">
      <h2>Log In</h2>
      <form method="POST" action="login.php">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" id="username" class="form-control" name="username" placeholder="Enter your username"
            required />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password"
            required />
        </div>
        <button type="submit" class="btn btn-primary">Log In</button>
        <div class="form-footer mt-3">
          <span class="toggle-link" onclick="toggleForm()">I don’t have an account</span>
        </div>
      </form>
    </div>

    <!-- Form Sign Up -->
    <div id="signUpForm" class="d-none">
      <h2>Sign Up</h2>
      <form method="POST" action="signup.php">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" class="form-control" name="email" placeholder="Enter your email" required />
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" id="username" class="form-control" name="username" placeholder="Choose a username"
            required />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" id="password" class="form-control" name="password" placeholder="Create a password"
            required />
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
        <div class="form-footer mt-3">
          <span class="toggle-link" onclick="toggleForm()">Already have an account? Log In</span>
        </div>
      </form>
    </div>
  </div>
</body>

</html>