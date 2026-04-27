<?php
session_start(); // Start the session to access stored user data

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: ../login.php");
    exit();
}

// Check if the logged-in user is an Admin (role_id = 1)
if ($_SESSION['role_id'] != 1) {
    // If the user is not an Admin, deny access
    echo "Access denied";
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