<?php
require_once '../config/config.php';

$_SESSION = [];

session_destroy();

header('Location:' . BASE_URL . '/index.php');
exit;
?>
