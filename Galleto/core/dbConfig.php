<?php 
session_start();
$host = "localhost";
$user = "root";
$password = "";
$dbname = "restaurant";
$dsn = "mysql:host={$host}; dbname={$dbname}";

$pdo = new PDO ($dsn, $user, $password);
$pdo -> exec("SET time_zone = '+8:00';");

?>