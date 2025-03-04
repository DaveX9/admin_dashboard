<?php
$servername = "localhost";  // Change if using a different host
$username = "root";         // Change to your DB username
$password = "";             // Change to your DB password
$dbname = "homespector";  // Change to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
