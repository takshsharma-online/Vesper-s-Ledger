<?php
// Force PHP to show errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database (Assuming this file is in the main folder next to db.php)
require_once '../db.php';

// 1. The Admin details
$email = "admin@mi6.gov";
$password = "systemoverride"; 
$role_id = 1; // 1 = System Administrator
$codename = "Director"; 

// Let PHP generate the secure hash automatically
$secure_hash = password_hash($password, PASSWORD_DEFAULT);

// 2. The query
$query = "INSERT INTO users (email, pass_hash, role_id, codename) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $query);

// 3. Bind the variables ("ssis" = String, String, Integer, String)
mysqli_stmt_bind_param($stmt, "ssis", $email, $secure_hash, $role_id, $codename);

if (mysqli_stmt_execute($stmt)) {
    echo "<h2>Success! Admin 'Director' has been added to the database.</h2>";
    echo "<p>You can now go to <a href='login.php'>login.php</a> and log in with the password: <strong>systemoverride</strong></p>";
} else {
    echo "Error creating Admin: " . mysqli_error($con);
}
?>