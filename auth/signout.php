<?php
require_once '../config/config.php';

if(isset($_SESSION['user_id'])){
    logActivity($pdo,$_SESSION['user_id'],$_SESSION['user_email'],'lagout','success');
}
$_SESSION = [];

session_destroy();

header('Location:' . BASE_URL . '/index.php');
exit;
?>
