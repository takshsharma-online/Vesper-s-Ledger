<?php
session_start();
include "../db.php";

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
</head>
<body>

<h2>My Missions</h2>

<hr>

<?php
// Check if there are missions
if (mysqli_num_rows($result) > 0) {

    // Loop through each mission
    while ($row = mysqli_fetch_assoc($result)) {

        echo "<div style='margin-bottom:15px;'>";

        // Display mission details
        echo "<b>Title:</b> " . $row['title'] . "<br>";
        echo "<b>Location:</b> " . $row['location'] . "<br>";

        echo "<a href='edit_mission.php?id=" . $row['mission_id'] . "'>Edit</a><br>";

        // Delete button with confirmation popup
        echo "<a href='delete_mission.php?id=" . $row['mission_id'] . "' 
                onclick='return confirm(\"Are you sure you want to delete this mission?\")'>Delete Mission
              </a><br>";

        // Link to manage (assign) agents for this specific mission      
        echo "<a href='assign_agents.php?id=" . $row['mission_id'] . "'>Manage Agents</a>";
      
        echo "</div><hr>";
    }

} else {
    // If no missions found
    echo "No missions found.";
}
?>

<br>
<a href="home.php">Back to Dashboard</a>

</body>
</html>