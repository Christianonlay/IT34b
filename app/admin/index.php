
<?php
require '../../config/config.php';

requireRole('admin');

$section = $_GET['section'] ?? '';

if ($section === 'activity-logs') {
    $stmt = $pdo->query("
        SELECT *
        FROM activity_logs
        ORDER BY activity_log_created_at ASC
    ");

    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

} elseif ($section === 'user-sessions') {
    $stmt = $pdo->query("
        SELECT
            us.session_id,
            us.user_id,
            u.user_username,
            u.user_email,
            u.user_role,
            us.session_start,
            us.session_end,
            us.session_duration
        FROM user_sessions us
        INNER JOIN users u ON us.user_id = u.user_id
        ORDER BY us.session_start DESC
    ");

    $sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            margin-top: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            vertical-align: middle;
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tbody tr:hover {
            background-color: #e9ecef;
        }

        h4 {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <h1>Welcome, Admin!</h1>

    <a href="../../auth/signout.php" class="btn btn-danger">
        Sign Out
    </a>

    <hr>

    <nav class="mb-3">
        <a href="index.php?section=activity-logs"
           class="btn btn-primary">
            Activity Logs
        </a>

        <a href="index.php?section=user-sessions"
           class="btn btn-primary">
            User Sessions
        </a>
    </nav>

    <?php if ($section === 'activity-logs'): ?>

        <h4>Activity Logs</h4>

        <div class="table-container">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>User ID</th>
                        <th>User Email</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>IP Address</th>
                        <th>User Agent</th>
                        <th>Date &amp; Time</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($activities)): ?>
                        <?php foreach ($activities as $activity): ?>
                            <tr>
                                <td><?= htmlspecialchars((string)($activity['activity_log_id'] ?? '')) ?></td>
                                <td><?= htmlspecialchars((string)($activity['user_id'] ?? '')) ?></td>
                                <td><?= htmlspecialchars((string)($activity['user_email'] ?? '')) ?></td>
                                <td><?= htmlspecialchars((string)($activity['activity_log_action'] ?? '')) ?></td>
                                <td><?= htmlspecialchars((string)($activity['activity_log_status'] ?? '')) ?></td>
                                <td><?= htmlspecialchars((string)($activity['activity_log_ip_address'] ?? '')) ?></td>
                                <td><?= htmlspecialchars((string)($activity['activity_log_user_agent'] ?? '')) ?></td>
                                <td><?= htmlspecialchars((string)($activity['activity_log_created_at'] ?? '')) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">
                                No activity logs found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    <?php elseif ($section === 'user-sessions'): ?>

        <h4>User Sessions</h4>

        <div class="table-container">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Session ID</th>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Session Start</th>
                        <th>Session End</th>
                        <th>Duration</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($sessions)): ?>
                        <?php foreach ($sessions as $session): ?>
                            <tr>
                                <td><?= htmlspecialchars((string)$session['session_id']) ?></td>
                                <td><?= htmlspecialchars((string)$session['user_id']) ?></td>
                                <td><?= htmlspecialchars((string)$session['user_username']) ?></td>
                                <td><?= htmlspecialchars((string)$session['user_email']) ?></td>
                                <td><?= htmlspecialchars((string)$session['user_role']) ?></td>
                                <td><?= htmlspecialchars((string)$session['session_start']) ?></td>

                                <td>
                                    <?= $session['session_end'] !== null
                                        ? htmlspecialchars((string)$session['session_end'])
                                        : 'Active' ?>
                                </td>

                                <td>
                                    <?php
                                    if ($session['session_duration'] !== null) {
                                        $totalSeconds = (int)$session['session_duration'];

                                        $hours = intdiv($totalSeconds, 3600);
                                        $minutes = intdiv($totalSeconds % 3600, 60);
                                        $seconds = $totalSeconds % 60;

                                        echo sprintf(
                                            '%02d hr %02d min %02d sec',
                                            $hours,
                                            $minutes,
                                            $seconds
                                        );
                                    } else {
                                        echo 'Active';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">
                                No user sessions found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    <?php endif; ?>

</body>
</html>
