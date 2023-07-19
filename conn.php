<?php
include_once 'db.php';
$con = new mysqli($hostname, $username, $password, $database);
if (mysqli_connect_errno())
  die(mysqli_connect_error());

$dsn = "mysql:host=$hostname;dbname=$database";
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

session_start();
date_default_timezone_set('Africa/Nairobi');
$datenow = date('m/d/Y',  time());
$timenow =  strtotime($datenow);
$timestamp = date('Y-m-d h:i:s',  time());
// define('BASE_URL', 'https://elctelvdhospital.info/version1');
define('BASE_URL', 'http://elvdhospital.test/version1');
