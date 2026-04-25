<?php

session_start();

//Check login user
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

//Check user role
if($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

?>