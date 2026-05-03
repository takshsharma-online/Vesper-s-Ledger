<?php

session_start();

//Check login user
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SESSION['role_id'] != 1) {
    header("Location: ../login.php");
    exit();
}

?>