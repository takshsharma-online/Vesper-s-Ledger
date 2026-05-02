<?php
require_once 'agent_auth.php';//Authentication for the agent.
require_once '../db.php';//Connects to the database.
$agent_id = $_SESSION['user_id'];//This code grabs the agent's ID from the session.

//Following is the query to find active missions linked to this specific agent.
$query = "SELECT m.mission_id, m.title, m.intel_brief, m.location, d.booking_date 
          FROM missions m
          JOIN deployments d ON m.mission_id = d.mission_id
          WHERE d.agent_id = ?";

$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $agent_id); // 'i' for integer
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agent Dashboard</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h1>Welcome, Agent <?php echo htmlspecialchars($_SESSION['codename']); ?></h1>
<p><a href="../login.php">Return to Login Gateway</a></p>

<hr>
<h2>Your Active Deployments</h2>

<?php
// 5. Check if they have any assigned missions
if (mysqli_num_rows($result) > 0) {

    // Loop through each mission and display it securely
    while ($mission = mysqli_fetch_assoc($result)) {
        echo "<div style='border: 1px solid #333; padding: 15px; margin-bottom: 15px; background-color: #f9f9f9;'>";

        // htmlspecialchars() prevents XSS attacks
        echo "<h3>" . htmlspecialchars($mission['title']) . "</h3>";
        echo "<p><strong>Location:</strong> " . htmlspecialchars($mission['location']) . "</p>";
        echo "<p><strong>Deployed On:</strong> " . htmlspecialchars($mission['booking_date']) . "</p>";
        echo "<p><strong>Intel Briefing:</strong><br> " . nl2br(htmlspecialchars($mission['intel_brief'])) . "</p>";

        echo "</div>";
    }
} else {
    echo "<p>You have no active assignments at this time. Relax, 007.</p>";
}
?>

</body>
</html>

