<?php
session_start(); // Start the session to access stored user data

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: ../login.php");
    exit();
}

// Check if the logged-in user is an Organiser (role_id = 2)
if ($_SESSION['role_id'] != 2) {
    // If the user is not an organiser, deny access
    echo "Access denied";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Organiser Dashboard</title>
</head>
<body>

<!-- Display welcome message with the user's codename -->
<h2>Welcome Chief of Station M</h2>

<hr>

<h3>Mission Control</h3>

<!-- Link to create a new mission -->
<a href="create_mission.php">Create Mission</a><br><br>

<!-- Link to view missions created by this organiser -->
<a href="view_missions.php">View My Missions</a><br><br>

<!-- Link to delete missions page -->
<a href="delete_missions.php">Delete Missions</a><br><br>

<hr>

<!-- Logout option -->
<a href="../logout.php">Logout</a>

</body>
</html>
