<?php
require_once 'config/config.php';
require_once 'config/function.php';


if(isset($_SESSION['user_id'])){
    header('location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
    exit;

}
$error = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

     if(isset($_SESSION['user_id'])){
        echo 'location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php';
        header('location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
        exit;

     }
    $error = 'Invalid login credentials';
}
?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST">
        <label>Username or Email</label>
        <input type="text"
                name="login"
                required>

        <br>
        <br>
        <label>password</label>
        <input type="password"
            name="password"
            required>

     
        <br>
        <button type="submit">Sign In</button>
</form>
</body>
