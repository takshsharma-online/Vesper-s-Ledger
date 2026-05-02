<?php
session_start(); // Start session
include "../db.php"; // Connect to database

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Get current organiser ID
$organiser_id = $_SESSION['user_id'];

// Query: get only missions created by this organiser
$sql = "SELECT * FROM missions WHERE organiser_id = '$organiser_id'";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Missions</title>

    <!-- Link to shared CSS file -->
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">

    <!-- Page header -->
    <div class="header">
        <h1>My Missions</h1>
        <p>Active operations under your command</p>
    </div>

    <hr>

<?php
// Check if there are missions
if (mysqli_num_rows($result) > 0) {

    // Loop through each mission
    while ($row = mysqli_fetch_assoc($result)) {

        // Mission box container (CSS)
        echo "<div class='mission-box'>";

        // Display mission details
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p><strong>Location:</strong> " . $row['location'] . "</p>";

        // Additional fields added (objective, intel, date)
        echo "<p><strong>Objective:</strong> " . $row['objective'] . "</p>";
        echo "<p><strong>Intel:</strong> " . $row['intel'] . "</p>";
        echo "<p><strong>Date Created:</strong> " . $row['date_created'] . "</p>";

        echo "<br>";

        // Edit mission link
        echo "<a href='edit_mission.php?id=" . $row['mission_id'] . "'>Edit</a> | ";

        // Delete mission with confirmation
        echo "<a href='delete_mission.php?id=" . $row['mission_id'] . "' 
                onclick='return confirm(\"Are you sure you want to delete this mission?\")'>
                Delete
              </a>";

        echo "</div>";
    }

} else {
    // If no missions found
    echo "<p class='no-missions'>No missions found.</p>";
}
?>

</div>

</body>
</html>