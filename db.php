<?php
$host = "mysql-262edf4d-redmanfinancevip-eaef.c.aivencloud.com";
$port = "24341";
$user = "avnadmin";
$pass = "AVNS_0hEBvdrVmvbBxL_plrx"; 
$db   = "defaultdb";

// Use $link instead of $conn
$link = mysqli_init(); 

mysqli_ssl_set($link, NULL, NULL, NULL, NULL, NULL);

$success = mysqli_real_connect(
    $link, 
    $host, 
    $user, 
    $pass, 
    $db, 
    $port, 
    NULL, 
    MYSQLI_CLIENT_SSL
);

if (!$success) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>


$conn = $link; 