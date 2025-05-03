<?php
$host = "localhost";
$user = "root";
$pass = "zainab123456789@hassan";
$dbname = "glamour"; 

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
