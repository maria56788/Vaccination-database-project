<?php
require_once '../database.php';
try {
    $statement = $conn->prepare("INSERT INTO cnc353_2.province (province, AgeGroupID) VALUES (:province, :ageGroupID)");

    $statement->bindParam(":province", $_POST["province"]);

    $statement->bindParam(":ageGroupID", $_POST["ageGroupID"]);

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: create.php");
}