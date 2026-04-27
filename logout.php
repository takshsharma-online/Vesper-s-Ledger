<?php
// Force PHP to show errors (for development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session
session_start(); // Access the current session

// Clear session data
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session completely

// Redirect user
header("Location: login.php"); // Send user back to login page
exit();
?>