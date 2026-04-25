<?php
include 'admin_auth.php';
include 'C:/xampp/htdocs/Vesper-s-Ledger/db.php';

//Read databse and get info
$id = $_GET['id'];

//Update status
$sql = "UPDATE users
        SET status='suspended'
        WHERE user_id=$id";

mysqli_quer($conn, $sql);

header("Locaion: manage_users.php");
exit();

?>