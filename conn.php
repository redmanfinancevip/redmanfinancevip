<?php
// Aiven Database Credentials
$host = "mysql-262edf4d-redmanfinancevip-eaef.c.aivencloud.com";
$port = "24341";
$user = "avnadmin";
$pass = "AVNS_0hEBvdrVmvbBxL_plrx"; 
$db   = "defaultdb";

// Initialize the connection object
$link = mysqli_init();

// Tell PHP to use SSL (Required by Aiven)
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);

// Establish the secure connection
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

// If you want to check if it's working, you can uncomment the line below:
// echo "Securely connected to Aiven Cloud Database!";
?>