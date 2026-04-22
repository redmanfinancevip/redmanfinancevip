<?php
/* InfinityFree Database Credentials - Redman Finance */
if(!defined('DB_SERVER')){
    define('DB_SERVER', 'sql313.infinityfree.com'); 
}
if(!defined('DB_USERNAME')){
    define('DB_USERNAME', 'if0_41703967');
}
if(!defined('DB_PASSWORD')){
    define('DB_PASSWORD', 'ocUMol9GLpWzj'); 
}
if(!defined('DB_NAME')){
    define('DB_NAME', 'if0_41703967_redmandb');
}

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>