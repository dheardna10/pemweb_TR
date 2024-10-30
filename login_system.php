<?php 

include 'connect.php';

if(isset($_POST['signUp'])){
    $email=$_POST['email'];
    $username=$_POST['name'];
    $password=$_POST['password'];
    $password=md5($password);

     $checkEmail="SELECT * From users where email='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }
     else{
        $insertQuery="INSERT INTO users(email,name,password)
                       VALUES ('$email','$username','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("location: tr.php");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
   

}

if(isset($_POST['signIn'])){
   $username=$_POST['name'];
   $password=$_POST['password'];
   $password=md5($password) ;
   
   $sql="SELECT * FROM users WHERE name='$username' and password='$password'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['name']=$row['name'];
    header("Location: tr.php");
    exit();
   }
   else{
    echo "Not Found, Incorrect Email or Password";
   }

}
?>