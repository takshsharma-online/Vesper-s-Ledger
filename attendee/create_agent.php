<?php
// Force PHP to show errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Go UP one folder to find the database connection
require_once '../db.php';

// 1. The FOUR variables needed for the database
$email = "009@mi6.gov";
$password = "password@abc";
$role_id = 3;
$codename = "009";

$secure_hash = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO users (email, pass_hash, role_id, codename) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $query);

// 3. The bind function has "ssis" and FOUR variables to match the question marks!
mysqli_stmt_bind_param($stmt, "ssis", $email, $secure_hash, $role_id, $codename);

if (mysqli_stmt_execute($stmt)) {
    echo "<h2>Success! Agent has been added to the database.</h2>";
    echo "<p>You can now go to <a href='../login.php'>login.php</a> and log in with the password you created. <strong></strong></p>";
} else {
    echo "Error creating agent: " . mysqli_error($con);
}
?>