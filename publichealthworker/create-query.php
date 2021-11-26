<?php
require_once '../database.php';
try {
    $publichealthworker = $conn->prepare("INSERT INTO cnc353_2.publichealthworker (facilityID, personID, employeeID, hourlyRate, jobType, SSN)
    VALUES (:facilityID, :personID, :employeeID, :hourlyRate, :jobType, :SSN)");

    $publichealthworker->bindParam(":facilityID",$_POST["facilityID"]);

    $publichealthworker->bindParam(":personID",$_POST["personID"]);

    $publichealthworker->bindParam(":employeeID",$_POST["employeeID"]);

    $publichealthworker->bindParam(":hourlyRate",$_POST["hourlyRate"]);

    $publichealthworker->bindParam(":jobType",$_POST["jobType"]);

    $publichealthworker->bindParam(":SSN",$_POST["SSN"]);

    $publichealthworker->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: create.php");
}