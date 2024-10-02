<?php
$servername = "localhost";
$username = "root";  
$password = "thinh3012002";  
$dbname = "phoneshoppping";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>