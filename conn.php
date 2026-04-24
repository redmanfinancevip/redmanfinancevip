<?php
$host = "mysql-262edf4d-redmanfinancevip-eaef.c.aivencloud.com";
$port = "24341";
$user = "avnadmin";
$pass = "AVNS_0hEBvdrVmvbBxL_plrx"; 
$db   = "defaultdb";

// 1. We name it $link here
$link = mysqli_init(); 

// 2. We MUST use $link here too (This is where your line 13 is failing)
mysqli_ssl_set($link, NULL, NULL, NULL, NULL, NULL);

// 3. And use $link here to connect
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