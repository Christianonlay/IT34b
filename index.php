<?php
require_once(__DIR__ . '/config/config.php');


if(isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
    exit();
}

$error='';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    

    $error = 'Invalid login credentials. Please try again.';

    if ($login=== '' || $password === '') {
        // Log incomplete login attempt
        logActivity($pdo,null,$login,'login','failed');

    }else{
        
        $result = loginUser($pdo,$login,$password);
        
        if($result===true){

        // Log incomplete login attempt
            logActivity($pdo,$_SESSION['user_id'],$_SESSION['user_email'],'login','success');

            echo 'Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php';
            header('Location: ' . BASE_URL . '/app/' . $_SESSION['user_role'] . '/index.php');
            exit;

        }elseif($result=== 'active_session'){
            echo 'This account is already logged in on another device';

            $error = 'This account is already logged in on another device';
            

        }else{
            $error = 'Invalid login credentials';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<form method="POST">
    <label>Username or Email</label>
    <input  type="text" 
            name="login" 
            required>

    <br>
    <br>
    <label>Password</label>
    <input  type="password"
            name="password" 
            required>
    <br>
    <button type="submit">Sign In</button>
</form>

    
</body>
</html>