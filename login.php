<?php
session_start();

// Fake login for testing
$_SESSION['user_id'] = 1;
$_SESSION['codename'] = "James Bond";
$_SESSION['role_id'] = 2;

// Redirect to organiser home
header("Location: organiser/home.php");
exit();
?>