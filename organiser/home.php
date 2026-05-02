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

    <!-- Link to shared CSS file -->
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">

    <!-- Display welcome message with the user's codename -->
    <div class="header">
        <h1>Welcome Chief of Station <?php echo $_SESSION['codename']; ?></h1>
    </div>

    <hr>

    <h3>Mission Control</h3>

    <!-- Navigation box styled like missions -->
    <div class="mission-box">

        <!-- Link to create a new mission -->
        <p><a href="create_mission.php">Create Mission</a></p>

        <!-- Link to view missions created by this organiser -->
        <p><a href="view_missions.php">View My Missions</a></p>

        <!-- Link to delete missions page -->
        <p><a href="delete_missions.php">Delete Missions</a></p>

    </div>

    <hr>

    <!-- Logout option -->
    <p style="text-align:center;">
        <a href="../logout.php">Logout</a>
    </p>

</div>

</body>
</html>