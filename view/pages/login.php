<?php

session_start();

include '../layouts/authLayout.php';
include '../components/auth.php';

$buttonName = 'login';
$buttonTitle = 'Login';
$error = null;

if (isset($_POST[$buttonName])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $res = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($res) == 1) {
        $result = mysqli_fetch_assoc($res);
        if (password_verify($password, $result['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['userId'] = $result['userId'];
            $_SESSION['firstName'] = $result['firstName'];
            $_SESSION['lastName'] = $result['lastName'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['role'] = $result['role'];

            if ($_SESSION["role"] == 1) {
                header("Location: adminDashboard.php");
                exit;
            } else {
                header("Location: home.php");
                exit;
            }
            exit;
        }   
     
    }
    $error = true;
}


?>



<?php Auth($firstName = false, $lastName = false, $buttonName = $buttonName, $buttonTitle = $buttonTitle, $error, $isRegister = false) ?>



<?php
    include '../layouts/authFooter.php'
?>
