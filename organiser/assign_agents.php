<?php
session_start();
include "../db.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$organiser_id = $_SESSION['user_id'];

// Check if mission ID exists
if (!isset($_GET['id'])) {
    echo "No mission selected.";
    exit();
}

// Get mission ID safely
$mission_id = intval($_GET['id']);

// OPTIONAL: Check that this mission belongs to this organiser
$check_mission = "SELECT * FROM missions 
                  WHERE mission_id='$mission_id' 
                  AND organiser_id='$organiser_id'";

$check_result = mysqli_query($con, $check_mission);

if (mysqli_num_rows($check_result) == 0) {
    echo "Mission not found or access denied.";
    exit();
}

// Get all agents (role_id = 3)
$sql_agents = "SELECT * FROM users WHERE role_id = 3";
$agents_result = mysqli_query($con, $sql_agents);

// Handle assignment
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $agent_id = intval($_POST['agent_id']);

    // Check if already assigned
    $check_sql = "SELECT * FROM deployments 
                  WHERE agent_id='$agent_id' 
                  AND mission_id='$mission_id'";

    $check_result = mysqli_query($con, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {

        echo "<p style='color:red;'>Agent already assigned.</p>";

    } else {

        // Insert assignment
        $insert_sql = "INSERT INTO deployments (agent_id, mission_id)
                       VALUES ('$agent_id', '$mission_id')";

        if (mysqli_query($con, $insert_sql)) {
            echo "<p style='color:green;'>Agent assigned successfully!</p>";
        } else {
            echo "<p style='color:red;'>Error: " . mysqli_error($con) . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Agents</title>
</head>
<body>

<h2>Assign Agents to Mission</h2>

<!-- Form to assign agent -->
<form method="POST">

    <label>Select Agent:</label>
    <select name="agent_id">

        <?php
        // Populate dropdown with agents
        while ($agent = mysqli_fetch_assoc($agents_result)) {
            echo "<option value='" . $agent['user_id'] . "'>" . $agent['codename'] . "</option>";
        }
        ?>

    </select>

    <br><br>
    <button type="submit">Assign Agent</button>

</form>

<hr>

<h3>Assigned Agents</h3>

<?php
// Show agents already assigned
$sql_assigned = "SELECT users.user_id, users.codename 
                 FROM deployments 
                 JOIN users ON deployments.agent_id = users.user_id
                 WHERE deployments.mission_id = '$mission_id'";

$result_assigned = mysqli_query($con, $sql_assigned);

if (mysqli_num_rows($result_assigned) > 0) {

    while ($agent = mysqli_fetch_assoc($result_assigned)) {

        echo $agent['codename'];

        // Remove agent link
        echo " <a href='remove_agent.php?agent_id=" . $agent['user_id'] . "&mission_id=" . $mission_id . "'>Remove</a>";

        echo "<br>";
    }

} else {
    echo "No agents assigned.";
}
?>

<br><br>
<a href="view_missions.php">Back to Missions</a>

</body>
</html>
