<?php
include 'admin_auth.php';
include 'C:/xampp/htdocs/Vesper-s-Ledger/db.php';

$sql = "SELECT * FROM audit_logs ORDER BY action_time DESC"
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Audit Logs</title>
    </head>
    <body>
        <h1>Audit Logs</h1>
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

        <p><a href="dashboard.php">Back</a></p>

    </body>
</html>