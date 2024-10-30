<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['signIn'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE name='$name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();

      if (password_verify($password, $row['password'])) {
        $_SESSION['name'] = $row['name'];
        header("Location: tr.php");
        exit();
      } else {
        echo "Incorrect Password";
      }
    } else {
      echo "Incorrect Name";
    }
  } elseif (isset($_POST['signUp'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $checkUser = "SELECT * FROM users WHERE email='$email' OR name='$name'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
      echo "Email or Name Already Exists!";
    } else {
      $insertQuery = "INSERT INTO users (email, name, password) VALUES ('$email', '$name', '$hashedPassword')";
      if ($conn->query($insertQuery) === TRUE) {
        header("Location: tr.php");
        exit();
      } else {
        echo "Error: " . $conn->error;
      }
    }
  } else {
    echo "Unauthorized access!";
  }
}
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
      <form method="POST" action="auth.php">
        <div class="mb-3">
          <label for="loginName" class="form-label">Name</label>
          <input type="text" id="loginName" class="form-control" name="name" placeholder="Enter your name" required />
        </div>
        <div class="mb-3">
          <label for="loginPassword" class="form-label">Password</label>
          <input type="password" id="loginPassword" class="form-control" name="password"
            placeholder="Enter your password" required />
        </div>
        <button type="submit" class="btn btn-primary" name="signIn">Log In</button>
        <div class="form-footer mt-3">
          <span class="toggle-link" onclick="toggleForm()">I don’t have an account</span>
        </div>
      </form>
    </div>

    <!-- Form Sign Up -->
    <div id="signUpForm" class="d-none">
      <h2>Sign Up</h2>
      <form method="POST" action="auth.php">
        <div class="mb-3">
          <label for="signUpEmail" class="form-label">Email</label>
          <input type="email" id="signUpEmail" class="form-control" name="email" placeholder="Enter your email"
            required />
        </div>
        <div class="mb-3">
          <label for="signUpName" class="form-label">Name</label>
          <input type="text" id="signUpName" class="form-control" name="name" placeholder="Choose a name" required />
        </div>
        <div class="mb-3">
          <label for="signUpPassword" class="form-label">Password</label>
          <input type="password" id="signUpPassword" class="form-control" name="password"
            placeholder="Create a password" required />
        </div>
        <button type="submit" class="btn btn-primary" name="signUp">Sign Up</button>
        <div class="form-footer mt-3">
          <span class="toggle-link" onclick="toggleForm()">Already have an account? Log In</span>
        </div>
      </form>
    </div>
  </div>
</body>

</html>