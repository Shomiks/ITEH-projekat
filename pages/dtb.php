<?php
$servername = "localhost";
$username = "root";
$password = "";
$datab="stomatoloska_ordinacija";

// Create connection
$conn = new mysqli($servername, $username, $password,$datab);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");
?>
