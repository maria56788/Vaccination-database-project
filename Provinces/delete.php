<?php

require_once "../database.php";

try {
    $statement = $conn->prepare("UPDATE cnc353_2.province SET exist = 0 WHERE cnc353_2.province.province = :province");

    $statement->bindParam(":province", $_GET["province"]);

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: index.php");
}