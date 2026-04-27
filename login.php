<?php
session_start();//Starts the session so we can store the user's ID and Role later.
require_once 'db.php';//Brings the database connection.
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $query = "SELECT user_id, pass_hash, role_id, codename FROM users WHERE email = ?";
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {

        if (password_verify($password, $row['pass_hash'])) {

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role_id'] = $row['role_id'];
            $_SESSION['codename'] = $row['codename'];

            if ($row['role_id'] == 3) {
                header("Location: attendee/dashboard_agent.php");
                exit();
            }
            elseif ($row['role_id'] == 2) {
                header("Location: organiser/home.php"); // Redirect organiser to their dashboard
                exit();
            }
            elseif ($row['role_id'] == 1) {
                header("Location: admin/dashboard.php"); // Redirect admin to admin panel
                exit();
            }
             else {
                $error_message = "Unknown user role.";
            }

        } else {
            $error_message = "Incorrect password.";
        }
    } else {
        $error_message = "No such user exists.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>MI6 Secure Login</title>
</head>
<body>
<nav class="navbar">
    <div class="logo-container">
        <img src="logo.png" alt="Logo" class="logo">
    </div>
</nav>
<h2>MI6 Secure Access</h2>

<?php if(!empty($error_message)) echo "<p style='color:red;'>$error_message</p>"; ?>

<form action="login.php" method="POST">
    <label>Email:</label>
    <input type="email" name="email" required><br><br>

    <label>Password:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>
</body>
</html>
