<?php
include 'admin_auth.php';
include '../db.php';

$sql = "SELECT * FROM audit_logs ORDER BY action_time DESC";
$result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../style.css">
        <title>Audit Logs</title>
    </head>
    <body>
        <nav class="navbar">
        <div class="logo-container">
            <img src="../testlogo.png" alt="logo" class="logo">
            <h2>MI6 Command - Audit Logs</h2>
        </div>
        </nav>
        <div class="container">
            <table border="1">
                <tr>
                    <th>Log ID</th>
                    <th>User ID</th>
                    <th>Action</th>
                    <th>Time</th>
                </tr>

                <?php
                while ($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>" . $row['log_id'] . "</td>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['action'] . "</td>";
                    echo "<td>" . $row['action_time'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <p><a href="dashboard.php">Back to Dashboard</a></p>
        </div>
    </body>
</html>