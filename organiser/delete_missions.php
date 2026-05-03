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

    // Only delete if the mission belongs to this organiser
    $sql = "DELETE FROM missions 
            WHERE mission_id = '$mission_id' 
            AND organiser_id = '$organiser_id'";


    if (mysqli_query($con, $sql)) {
        // Redirect back after deletion

        //AUDIT LOG STARTS HERE
        $user_id = $_SESSION['user_id'];
        $action = "Deleted mission";
        $details = "Mission ID: $mission_id";

        $log_sql = "INSERT INTO audit_logs (user_id, action, details) VALUES (?, ?, ?)";
        $log_stmt = mysqli_prepare($con, $log_sql);
        mysqli_stmt_bind_param($log_stmt, "iss", $organiser_id, $action, $details);
        mysqli_stmt_execute($log_stmt);
        //AUDIT LOG ENDS HERE

        echo "<div class='mission-box'>";
        echo "<h3>Mission Deleted</h3>";
        echo "<p>The mission has been successfully removed.</p>";
        echo "<a href='view_missions.php'>Back to Missions</a>";
        echo "</div>";

        exit();

    } else {
        echo "<div class='mission-box'>";
        echo "<h3>Error deleting mission</h3>";
        echo "<p>" . mysqli_error($con) . "</p>";
        echo "</div>";
    }

} else {
    echo "<div class='mission-box'>";
    echo "<h3>No mission selected</h3>";
    echo "<p>Please select a mission to delete.</p>";
    echo "</div>";
}
?>

</div>

</body>
</html>