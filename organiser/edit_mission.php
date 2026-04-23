<?php
session_start();
include "../db.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Check if mission ID is provided
if (!isset($_GET['id'])) {
    echo "No mission selected.";
    exit();
}

// Convert mission ID to integer (basic security)
$mission_id = intval($_GET['id']);
$organiser_id = $_SESSION['user_id'];

// Get current mission data (only if it belongs to this organiser)
$sql = "SELECT * FROM missions 
        WHERE mission_id = '$mission_id' 
        AND organiser_id = '$organiser_id'";

$result = mysqli_query($con, $sql);

// If mission not found or not owned by this organiser
if (mysqli_num_rows($result) == 0) {
    echo "Mission not found or access denied.";
    exit();
}

// Fetch mission data
$mission = mysqli_fetch_assoc($result);

// Handle form submission (UPDATE)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get and clean input data
    $title = trim($_POST['title']);
    $location = trim($_POST['location']);

    // Validate inputs
    if (empty($title) || empty($location)) {
        echo "<p style='color:red;'>All fields are required.</p>";
    } else {

        // Update mission in database
        $update_sql = "UPDATE missions 
                       SET title='$title', location='$location'
                       WHERE mission_id='$mission_id' 
                       AND organiser_id='$organiser_id'";

        if (mysqli_query($con, $update_sql)) {

            // Redirect after successful update
            header("Location: view_missions.php");
            exit();

        } else {
            echo "<p style='color:red;'>Error updating mission: " . mysqli_error($con) . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Mission</title>
</head>
<body>

<h2>Edit Mission</h2>

<form method="POST">

    <!-- Title input -->
    Title:
    <input type="text" name="title" value="<?php echo htmlspecialchars($mission['title']); ?>">
    <br><br>

    <!-- Location input -->
    Location:
    <input type="text" name="location" value="<?php echo htmlspecialchars($mission['location']); ?>">
    <br><br>

    <!-- Submit button -->
    <button type="submit">Update Mission</button>

</form>

<br>

<!-- Back link -->
<a href="view_missions.php">Back to Missions</a>

</body>
</html>