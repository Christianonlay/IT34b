<?php
require_once '../../config/config.php';
require_once '../../config/function.php';

requireRole('admin');

logActivity(
    $pdo,
    $_SESSION['user_id'],
    $_SESSION['user_email'],
    'view_activity_logs'
);

//  Get All Activity Logs

$stmt = $pdo->query("
    SELECT *
    FROM activity_logs
    ORDER BY activity_log_created_at DESC
");

$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome Admin</h1>
   <a href="../../auth/signout.php">Sign Out</a>
   <table border="1">

        <thead>

            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Email</th>
                <th>Action</th>
                <th>Status</th>
                <th>IP Address</th>
                <th>User Agent</th>
                <th>Date & Time</th>
                 </tr>

        </thead>


        <tbody>

            <?php foreach ($activities as $activity): ?>

                <tr>
</body>
</html>