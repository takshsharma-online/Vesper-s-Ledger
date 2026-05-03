<?php

include 'admin_auth.php';
include '../db.php'; //Database connection

//Get all users from database
$sql = "SELECT * FROM users";
$result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../style.css">
        <title>Manage Users</title>
    </head>
    <body>
        <nav class="navbar">
        <div class="logo-container">
            <img src="../testlogo.png" alt="logo" class="logo">
            <h2>MI6 Command - Manage Users</h2>
        </div>
        </nav>
        <br>
        <div class="container">
            <table border="1">
                <tr>
                    <th>User ID</th>
                    <th>Code Name</th>
                    <th>Email</th>
                    <th>Role ID</th>
                    <th>Creation Time</th>
                    <th>Actions</th>
                </tr>
                <?php
                    //Check users
                    if(mysqli_num_rows($result) > 0) {
                        //Loop through each row
                        while ($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>" . $row['user_id'] . "</td>";
                            echo "<td>" . $row['codename'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['role_id'] . "</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            
                            echo "<td>
                                    <a href='promote_user.php?id={$row['user_id']}'>Promote</a><br>
                                    <a href='suspend_user.php?id={$row['user_id']}'>Suspend</a>
                                </td>";

                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No users found</td></tr>";
                    }
                ?>
            </table>

            <p><a href="dashboard.php">Back to Dashboard</a></p>
        </div>
    </body>
</html>