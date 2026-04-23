<?php
session_start();
include "../db.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $title = trim($_POST['title']);
    $location = trim($_POST['location']);

    $organiser_id = $_SESSION['user_id'];

    // Basic validation
    if (empty($title) || empty($location)) {
        echo "Please fill in all fields.";
    } else {

        // Insert mission into database
        $sql = "INSERT INTO missions (title, location, organiser_id)
                VALUES ('$title', '$location', '$organiser_id')";

        if (mysqli_query($con, $sql)) {

            // Redirect after success
            header("Location: home.php");
            exit();

        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Mission</title>
</head>
<body>

<h2>Create New Mission</h2>

<form method="POST">
    Title: <input type="text" name="title"><br><br>
    Location: <input type="text" name="location"><br><br>

    <button type="submit">Create Mission</button>
</form>

<br>
<a href="home.php">Back to Dashboard</a>

</body>
</html>