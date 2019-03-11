<?php
$servername = "localhost";
$username = "crickbooks_root";
$password = "ec2vq0fK6HQ-";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>