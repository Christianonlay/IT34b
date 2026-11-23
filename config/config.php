<?php
session_start();

require_once(__DIR__ . '/../functions/activity.php');
require_once(__DIR__ . '/../functions/auth.php');
require_once(__DIR__ . '/../functions/redirect.php');
require_once(__DIR__ . '/../functions/session.php');
require_once(__DIR__ . '/../functions/csrf.php');
require_once(__DIR__ . '/../functions/csv.php');

require_once(__DIR__ . '/../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


define('DB_HOST',$_ENV['DB_HOST'] ?? '');
define('DB_NAME',$_ENV['DB_NAME'] ?? '');
define('DB_USER',$_ENV['DB_USER'] ?? '');
define('DB_PASS',$_ENV['DB_PASS'] ?? '');

// define('','');
define('BASE_URL','http://localhost/IT34B_1/');


try{
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
   
}catch(PDOException $e){
    die("Connection failed: " . $e->getMessage());
    
}
?>