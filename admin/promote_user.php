<?php

include 'admin_auth.php';
include 'C:/xampp/htdocs/Vesper-s-Ledger/db.php';

//Read database
$id = $_GET['id'];

//Update role
$sql = "UPDATE users
        SET role 'organiser'
        WHERE user_id=$id";

mysqli_query($conn, $sql);

header("Location: manage_users.php");
exit();

?>