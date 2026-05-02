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
    $objective = trim($_POST['objective']);
    $intel = trim($_POST['intel']);
    $date = trim($_POST['date']);

    $organiser_id = $_SESSION['user_id'];

    // Validation
    if (empty($title) || empty($location) || empty($objective) || empty($intel) || empty($date)) {
        $error = "Please fill in all fields.";
    } else {

        // Insert mission into database
        $sql = "INSERT INTO missions (title, location, organiser_id, objective, intel, date_created)
                VALUES ('$title', '$location', '$organiser_id', '$objective', '$intel', '$date')";

        if (mysqli_query($con, $sql)) {
            header("Location: home.php");
            exit();
        } else {
            $error = "Error: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Mission</title>

    <!-- Link to shared CSS file -->
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="container">

    <!-- Page header -->
    <div class="header">
        <h1>Create New Mission</h1>
    </div>

    <hr>

    <!-- Show error if exists -->
    <?php if (isset($error)) echo "<p>$error</p>"; ?>

    <form method="POST">

        Title:
        <input type="text" name="title"><br><br>

        Location:
        <input type="text" name="location"><br><br>

        Objective:<br>
        <textarea name="objective" rows="3" cols="40"></textarea><br><br>

        Intel / Description:<br>
        <textarea name="intel" rows="4" cols="50"></textarea><br><br>

        Date Created:
        <input type="text" name="date"><br><br>

        <button type="submit">Create Mission</button>

    </form>

    <br>

    <p style="text-align:center;">
        <a href="home.php">Back to Dashboard</a>
    </p>

</div>

</body>
</html>