<?php
session_start();
include "../db.php";

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Mission</title>

    <!-- Link to shared CSS file -->
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">

<?php
// Check if mission ID is provided
if (isset($_GET['id'])) {

    $mission_id = $_GET['id'];
    $organiser_id = $_SESSION['user_id'];

    // IMPORTANT: Only delete if the mission belongs to this organiser
    $sql = "DELETE FROM missions 
            WHERE mission_id = '$mission_id' 
            AND organiser_id = '$organiser_id'";

    if (mysqli_query($con, $sql)) {

        // Success message (styled)
        echo "<div class='mission-box'>";
        echo "<h3>Mission Deleted</h3>";
        echo "<p>The mission has been successfully removed.</p>";
        echo "<a href='view_missions.php'>Back to Missions</a>";
        echo "</div>";

    } else {
        // Error message
        echo "<div class='mission-box'>";
        echo "<h3>Error</h3>";
        echo "<p>Error deleting mission: " . mysqli_error($con) . "</p>";
        echo "</div>";
    }

} else {
    // No mission selected
    echo "<div class='mission-box'>";
    echo "<h3>No Mission Selected</h3>";
    echo "<p>Please select a mission to delete.</p>";
    echo "</div>";
}
?>

</div>

</body>
</html>