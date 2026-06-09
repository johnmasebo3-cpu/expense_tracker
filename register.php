<?php
// Include the database configuration connection
require 'db.php';
$msg = "";

// Check if registration form is submitted
if (isset($_POST['register'])) {
    $username = $conn->real_escape_string($_POST['username']);
    // Encrypt the password securely before saving
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 

    // Check if username is already taken
    $check = $conn->query("SELECT id FROM users WHERE username='$username'");
    if ($check->num_rows > 0) {
        $msg = "<p style='color:red;'>Username already taken!</p>";
    } else {
        // Insert new user profile into the database
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($sql)) {
            $msg = "<p style='color:green;'>Registration successful! <a href='login.php'>Login here</a></p>";
        } else {
            $msg = "<p style='color:red;'>Error creating account.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Expense Tracker</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-container">
        <h2>Create Account</h2>
        <?php echo $msg; ?>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn">Register</button>
        </form>
        <p style="margin-top:15px;">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>