<?php
    include 'admin_auth.php'; //Run authentication firstS
    session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MI^ Command Dashboard</title>
    </head>
    <body>
        <h1>MI6 Command Center</h1>
        <p>Welcome.</p>

        <ul>
            <li><a href="manage_users.php">Manage Agents</a></li>
            <li><a href="audit_logs.php">View Logs</a></li>
        </ul>
        <form method="POST">
            <button type="submit" name="logout">Logout</button>
<       /form>
    </body>
</html>