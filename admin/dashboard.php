<?php
session_start(); // Start the session to access stored user data

//Logout option
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../logout.php");
    exit();
}


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
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../style.css">
        <title>MI6 Command Dashboard</title>
    </head>
    <body>
    <nav class="navbar">
        <div class="logo-container">
            <img src="../testlogo.png" alt="logo" class="logo">
            <h2>MI6 Command Center</h2>
        </div>
    </nav>
    <div class="header">
        <h1>Welcome, Director</h1>
        <p>Dashboard</p>
    </div>
    <div class="container">
            <ul>
                <li><a href="manage_users.php">Manage Agents</a></li>
                <li><a href="audit_logs.php">View Logs</a></li>
            </ul>
    </div>
        <footer>
            <form method="POST">
                <button type="submit" name="logout">Logout</button>
            </form>
        </footer>
    </body>
</html>