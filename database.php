<?php
session_start();
$host = 'cnc353.encs.concordia.ca';
$username = 'cnc353_2';
$password = 'cloudy56';
$db = 'cnc353_2';
$port = "3306";
$charset = 'utf8mb4';

$options = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";

try {
    $conn = new \PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Could not connect to lol". $e->getMessage());
}

?>
