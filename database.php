<?php
session_start();
$server = 'cnc353.encs.concordia.ca:3306';
$username = 'w_chitta';
$password = 'cloudy56';
$database = 'cnc353_2';

try {
    $conn = new PDO("mysql:host=$server,dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die("Could not connect to". $e->getMessage());
}

?>