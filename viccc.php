<?php 



$servername = "localhost";
$username = "fxpp_admin";
$password = "";

// Create connection
$conn = new mysqli_connect($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";



?>