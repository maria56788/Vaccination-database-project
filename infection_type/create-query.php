<?php
require_once '../database.php';
try {
    $statement = $conn->prepare("INSERT INTO cnc353_2.infection_type (infID, infectionName) VALUES (:infID, :infectionName)");

    $statement->bindParam(":infID", $_POST["infID"]);

    $statement->bindParam(":infectionName", $_POST["infectionName"]);

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: create.php");
}