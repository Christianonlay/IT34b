<?php
 require_once'config/config.php';

 $user_id = "root" ?? null;
 $user_email = "root" ?? null;

 $buttons = [
    'Login',
    'Lagout',
    'Create Record',
    'Update record',
    'Delete Record',
    'View Record',
    'upload File',
    'Download',
    'Search',
    'Generate Report'

 ];
 ?>

 <table border="1" cellpadding="10">
    <tr>
        <th>Action</th>
        <th>Test</th>
</tr>
<?php foreach ($buttons as $button): ?>
    <tr>
        <td><?= htmlspecialchars($button) ?></td>
        <td>
            <form method="post">
                <input type="hidden" name="action"
                value="<?= htmlspecialchars($button) ?>"
                >
                <button type="submit">Test</button>
</form>
</td>
</tr>
<?php endforeach; ?>
</table>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $action = $_POST['action'] ?? "test_activity";

    $status = random_int(0,1) === 1? 'success':'failed';

    $success = logActivity(
        $pdo,
        $user_id,
        $user_email,
        $action,
        $status
    );

    if($success){
        echo "<p>Activity: " . htmlspecialchars($action) .
        " Status: " . htmlspecialchars($status) .
        " Log inserted successfully </p>";
    }else{
        echo "<p>Failed to insert activity log</P>";
    }

    }
?>