<?php
// Include database configuration connection
require 'db.php';
session_start(); // Start safe session handling
$msg = "";

// Check if login form is submitted
if (isset($_POST['login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Search for user in database
    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify encrypted database password match
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php"); // Send user to central workspace dashboard
            exit;
        } else {
            $msg = "<p style='color:red;'>Incorrect password!</p>";
        }
    } else {
        $msg = "<p style='color:red;'>User profile not found!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Expense Tracker</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-container">
        <h2>Secure Login</h2>
        <?php echo $msg; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn">Login</button>
        </form>
        <p style="margin-top:15px;">New here? <a href="register.php">Create account</a></p>
    </div>
</body>
</html>