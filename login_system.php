<?php
session_start();
include 'connect.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['signIn'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $username = $conn->real_escape_string($_POST['username']);
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email=? AND username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['username'] = $row['username'];
                header("Location: tr.php");
                exit();
            } else {
                $error = "Incorrect Password";
            }
        } else {
            $error = "Incorrect Email or Username";
        }
        $stmt->close();
    } elseif (isset($_POST['signUp'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $username = $conn->real_escape_string($_POST['username']);
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $checkUser = "SELECT * FROM users WHERE email=? OR username=?";
        $stmt = $conn->prepare($checkUser);
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email or Username Already Exists!";
        } else {
            $insertQuery = "INSERT INTO users (email, username, password) VALUES (?, ?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bind_param("sss", $email, $username, $hashedPassword);

            if ($insertStmt->execute()) {
                header("Location: tr.php");
                exit();
            } else {
                $error = "Error: " . $conn->error;
            }
            $insertStmt->close();
        }
        $stmt->close();
    }
}
?>