<?php

include 'admin_auth.php';
include 'C:/xampp/htdocs/Vesper-s-Ledger/db.php'; //Database connection

//Get all users from database
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Manage Users</title>
    </head>
    <body>
        <h1>MI^ Command - Manage Users</h1>
        <table border="1">
            <tr>
                <th>User ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php
                //Check users
                if(mysqli_num_rows($result) > 0) {
                    //Loop through each row
                    while ($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['full_name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['role'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        
                        echo "<td>";
                        echo "<a href='promote_user.php?id=" . $row[user_id] . "'>Promote</a>";
                        echo "<a href='suspend_user.php?id=" . $row[user_id] . "'>Suspend</a>";
                        echo "</td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No users found</td></tr>";
                }
            ?>
        </table>

        <p><a href="dashboard.php">Back to Dashboard</a></p>

    </body>
</html>