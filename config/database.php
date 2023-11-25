<?php
$server_name    = "localhost";
$username       = "root";
$password       = "root";
$database       = "jerome"; 
$port           = "3306"; 

$conn = mysqli_connect(
    $server_name,
    $username,
    $password,
    $database,
    $port
);

if (!$conn) {
    die("Connection Failed:" . mysqli_connect_error());
}