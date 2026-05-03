<?php

include 'admin_auth.php';
include '../db.php';

if (!isset($_GET['id']) || !isset($_GET['to'])) {
    exit("No user selected");
}

//Read database and get info
$id = $_GET['id'];
$to = $_GET['to'];

//Prevent demoting admins (optional)
if($id == $_SESSION['user_id'] && $to != 1){
    $_SESSION['message'] = "Admins cannot demote admins";
    header("Location: manage_users.php");
    exit();
}

//Update role dynamically
$sql = "UPDATE users SET role_id = ? WHERE user_id = ? AND role_id != 1";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "ii", $to, $id);
mysqli_stmt_execute($stmt);

// Check result ONCE
$success = mysqli_stmt_affected_rows($stmt) > 0;

// Audit log ONLY if success
if ($success) {
    $admin_id = $_SESSION['user_id'];
    $action = "User demoted";
    $details = "User ID: $id changed to role $to";

    $log_sql = "INSERT INTO audit_logs (user_id, action, details) VALUES (?, ?, ?)";
    $log_stmt = mysqli_prepare($con, $log_sql);
    mysqli_stmt_bind_param($log_stmt, "iss", $admin_id, $action, $details);
    mysqli_stmt_execute($log_stmt);

    $_SESSION['message'] = "User demoted successfully";
} else {
    $_SESSION['message'] = "No changes made.";
}


header("Location: manage_users.php");
exit();

?>