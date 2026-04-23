<?php
session_start();//Starts the session.
//Following codes check for Field Agent clearance.
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 3) {
    header("Location: ../login.php?error=AccessDenied");//Kicks them out to rhe main login page.
    exit();
}
