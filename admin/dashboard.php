<?php
    include 'admin_auth.php'; //Run authentication firstS
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MI^ Command Dashboard</title>
    </head>
    <body>
        <h1>MI6 Command Center</h1>
        <p>Welcome, Commander.</p>

        <ul>
            <li><a href="manage_users.php">Manage Agents</a></li>
            <li><a href="audit_logs.php">View Logs</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </body>
</html>