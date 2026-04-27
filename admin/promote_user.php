<?php

include 'admin_auth.php';
include 'C:/xampp/htdocs/Vesper-s-Ledger/db.php';

//Read database and get info
$id = $_GET['id'];

//Update role
$sql = "UPDATE user
        SET role 'organiser'
        WHERE user_id=$id";

mysqli_query($conn, $sql);

header("Location: manage_users.php");
exit();

?>