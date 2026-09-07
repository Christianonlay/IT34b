<?php

function redirect($path){
    header("Location: " . BASE_URL . $path);
    exit;
}

function loginUser($pdo, $login, $password){
    #Query 2
     $sql = "
        SELECT
            user_id,
            user_email,
            user_username,
            user_password,
            user_role
        FROM users
        WHERE user_email = :login
           OR user_username = :login
        LIMIT 1
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':login' => $login]);

    $user = $stmt->fetch();

    if (!$user) {
        return false;
    }

    if (!password_verify($password, $user['user_password'])) {
        return false;
    }

    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['user_email'] = $user['user_email'];
    $_SESSION['user_username'] = $user['user_username'];
    $_SESSION['user_role'] = $user['user_role'];

    return true;
}

?>