<?php
require_once '../../config/config.php';


requireRole('admin');

logActivity(
    $pdo,
    $_SESSION['user_id'],
    $_SESSION['user_email'],
    'view_activity_logs'
);

// Get All Activity Logs

$stmt = $pdo->query("
    SELECT *
    FROM activity_logs
    ORDER BY activity_log_created_at ASC
");

$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Activity Logs</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 30px;
            color: #333;
        }

        h1 {
            margin-bottom: 10px;
        }

        /* Sign Out */
        .sign-out {
            display: inline-block;
            background-color: #333;
            color: white;
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .sign-out:hover {
            background-color: #555;
        }

        /* Table */
        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 6px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #333;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 10px 12px;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:hover {
            background-color: #f2f2f2;
        }

        /* Status */
        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 13px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .failed {
            background-color: #f8d7da;
            color: #721c24;
        }

    </style>

</head>

<body>

    <h1>Welcome Admin</h1>

    <a href="../../auth/signout.php" class="sign-out">
        Sign Out
    </a>

    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>Record ID</th>
                    <th>User ID</th>
                    <th>User Email</th>
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

                        <td>
                            <?= htmlspecialchars($activity['activity_log_id']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($activity['user_id']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($activity['user_email']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($activity['activity_log_action']) ?>
                        </td>

                        <td>

                            <?php if (strtolower($activity['activity_log_status']) === 'success'): ?>

                                <span class="status success">
                                    <?= htmlspecialchars($activity['activity_log_status']) ?>
                                </span>

                            <?php else: ?>

                                <span class="status failed">
                                    <?= htmlspecialchars($activity['activity_log_status']) ?>
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>
                            <?= htmlspecialchars($activity['activity_log_ip_address']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($activity['activity_log_user_agent']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($activity['activity_log_created_at']) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</body>

</html>
