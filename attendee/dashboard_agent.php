<?php
// Start the session and include necessary files
session_start();
require_once 'agent_auth.php'; // Ensure the user is authenticated as an agent
require_once '../db.php'; // Database connection

$agent_id = $_SESSION['user_id']; // Get the agent's ID from the session

// Query to fetch all active missions (no need to join with deployments)
$query = "SELECT 
            mission_id, 
            title, 
            intel, 
            location, 
            date_created 
          FROM missions
          WHERE status = 'Active'"; // Only fetch active missions

$stmt = mysqli_prepare($con, $query);

if (!$stmt) {
    die("SQL Error: " . mysqli_error($con)); // Error handling if the query preparation fails
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt); // Execute the query and get the result
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agent Dashboard</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.4); /* Black with opacity */
        }

        .modal-content {
            background-color: #222;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #d4af37;
            width: 80%;
            border-radius: 10px;
            text-align: center;
            color: #FFD700;
        }

        .close {
            color: #d4af37;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            right: 15px;
            top: 10px;
        }

        .close:hover,
        .close:focus {
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }

        /* Custom styles for the Accept button */
        .accept-btn {
            background-color: green; /* Green background */
            color: white; /* White text */
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
            font-size: 16px;
        }

        .accept-btn:hover {
            background-color: darkgreen; /* Darker green on hover */
        }
    </style>
</head>
<body>

<h1>Welcome, Agent <?php echo htmlspecialchars($_SESSION['codename']); ?></h1>
<p><a href="../login.php">Return to Login Gateway</a></p>

<hr>

<h2>Your Active Missions</h2>

<?php
if ($result && mysqli_num_rows($result) > 0) {

    while ($mission = mysqli_fetch_assoc($result)) {
        ?>
        <div style="border: 1px solid #FFD700; padding: 15px; margin-bottom: 15px; background-color: #111; border-radius: 10px;">

            <h3><?php echo htmlspecialchars($mission['title']); ?></h3>

            <p><strong>Location:</strong>
                <?php echo htmlspecialchars($mission['location']); ?>
            </p>

            <p><strong>Created On:</strong>
                <?php echo htmlspecialchars($mission['date_created']); ?>
            </p>

            <p><strong>Intel Briefing:</strong><br>
                <?php echo nl2br(htmlspecialchars($mission['intel'])); ?>
            </p>

            <!-- Accept button form (with JavaScript to handle click and modal) -->
            <button type="button" class="accept-btn" onclick="acceptMission(<?php echo $mission['mission_id']; ?>)">
                Accept Mission
            </button>

        </div>
        <?php
    }

} else {
    echo "<p>You have no active missions at this time. Relax, 007.</p>";
}
?>

<!-- The Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Request Submitted. The Headquarters will be informed.</p>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // Function to show the modal
    function showModal() {
        modal.style.display = "block";

        // Hide the modal after 3 seconds
        setTimeout(function() {
            modal.style.display = "none";
        }, 3000);
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Function to handle the mission acceptance
    function acceptMission(mission_id) {
        // Here we will simulate the mission acceptance (e.g., via AJAX or form submission)
        // Show the modal when the mission is accepted
        showModal();

        // You can also make an AJAX call here to submit the mission acceptance if needed.
        // For simplicity, we're just simulating it with the modal for now.

        // After showing the modal, if needed, you can handle the backend logic (submit via AJAX, etc.)
        // Note: No page reload or form submission occurs in this solution, everything happens on the front-end.
    }
</script>

</body>
</html>