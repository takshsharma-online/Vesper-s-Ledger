<?php
session_start();
include "../db.php";

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Check if mission ID is provided
if (isset($_GET['id'])) {

    $mission_id = $_GET['id'];
    $organiser_id = $_SESSION['user_id'];

    // IMPORTANT: Only delete if the mission belongs to this organiser
    $sql = "DELETE FROM missions 
            WHERE mission_id = '$mission_id' 
            AND organiser_id = '$organiser_id'";

    if (mysqli_query($con, $sql)) {
        // Redirect back after deletion
        header("Location: view_missions.php");
        exit();
    } else {
        echo "Error deleting mission: " . mysqli_error($con);
    }

} else {
    echo "No mission selected.";
}
?>