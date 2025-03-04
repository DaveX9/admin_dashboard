<?php
$servername = "localhost"; // Change this if using a different database host
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "admin_dashboard"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character encoding
$conn->set_charset("utf8");
?>
