<?php
// Show errors (for testing)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to database
require_once 'db.php';

// Organiser details
$email = "m@mi6.gov";
$password = "topsecret";
$codename = "M";
$role_id = 2; // 2 = Organiser

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert into database
$sql = "INSERT INTO users (email, pass_hash, role_id, codename) 
        VALUES ('$email', '$hashed_password', '$role_id', '$codename')";

if (mysqli_query($con, $sql)) {
    echo "Organiser created successfully!<br>";
    echo "Email: m@mi6.gov<br>";
    echo "Password: topsecret<br>";
    echo "<a href='login.php'>Go to login</a>";
} else {
    echo "Error: " . mysqli_error($con);
}
?>