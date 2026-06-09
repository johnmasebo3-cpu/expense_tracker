<?php
// Database configuration details
$host = "localhost:3307"; // Updated to 3307 to bypass your local port conflict
$user = "root";           // Default XAMPP MySQL username
$pass = "";               // Default XAMPP MySQL password is empty
$dbname = "expense_tracker"; // The name of our database

// Establish connection to MySQL
$conn = new mysqli($host, $user, $pass, $dbname);

// Check if the connection failed
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>