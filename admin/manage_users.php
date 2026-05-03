<?php
include 'admin_auth.php';
include '../db.php'; //Database connection

/*Get all users from database*/
$sql = "SELECT * FROM users";
$result = mysqli_query($con, $sql);

if (isset($_SESSION['message'])) {
    echo "<p>" . $_SESSION['message'] . "</p>";
    unset($_SESSION['message']);
}

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
            <?php
            if (isset($_SESSION['message'])) {
                echo "<p>" . $_SESSION['message'] . "</p>";
                unset($_SESSION['message']);
            }
            ?>
            <table border="1">
                <tr>
                    <th>User ID</th>
                    <th>Code Name</th>
                    <th>Email</th>
                    <th>Role ID</th>
                    <th>Creation Time</th>
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
                            echo "<td>" . $row['codename'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['role_id'] . "</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            
                            echo "<td>";

                            // Promote logic
                            if ($row['role_id'] == 3) {
                                echo "<a href='promote_user.php?id={$row['user_id']}&to=2'>Promote to Organiser</a><br>";
                            }
                            if ($row['role_id'] == 2) {
                                echo "<a href='promote_user.php?id={$row['user_id']}&to=1'>Promote to Admin</a><br>";
                            }

                            // DEMOTE
                            if ($row['role_id'] == 1) {
                                echo "<a href='demote_user.php?id={$row['user_id']}&to=2'>Demote to Organiser</a><br>";
                            } elseif ($row['role_id'] == 2) {
                                echo "<a href='demote_user.php?id={$row['user_id']}&to=3'>Demote to User</a><br>";
                            }

                            // Suspend/Unsuspend logic
                            if ($row['role_id'] != 1) {

                                    if ($row['status'] == 'active') {
                                        echo "<a href='suspend_user.php?id={$row['user_id']}'>Suspend</a>";
                                    } else {
                                        echo "<a href='unsuspend_user.php?id={$row['user_id']}'>Unsuspend</a>";
                                    }
                                }
                            echo "</td>";
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