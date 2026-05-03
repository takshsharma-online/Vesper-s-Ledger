<?php

include 'admin_auth.php';
include '../db.php';

if (!isset($_GET['id'])) {
    exit("No user selected");
}

$id = $_GET['id'];

// Unsuspend user
$sql = "UPDATE users SET status = 'active' WHERE user_id = ? AND role_id != 1";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$success = mysqli_stmt_affected_rows($stmt) > 0;

// Audit log
if ($success) {
    $admin_id = $_SESSION['user_id'];
    $action = "User unsuspended";
    $details = "User ID: $id reactivated";

    $log_sql = "INSERT INTO audit_logs (user_id, action, details) VALUES (?, ?, ?)";
    $log_stmt = mysqli_prepare($con, $log_sql);
    mysqli_stmt_bind_param($log_stmt, "iss", $admin_id, $action, $details);
    mysqli_stmt_execute($log_stmt);

    $_SESSION['message'] = "User unsuspended successfully";
} else {
    $_SESSION['message'] = "No changes made";
}

header("Location: manage_users.php");
exit();

?>