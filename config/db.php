<?php
require_once 'constants.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
function getIp(){

    $ip = $_SERVER['REMOTE_ADDR'];     
    if($ip){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $ip;
    }
    return false;
}
