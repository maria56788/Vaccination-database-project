<?php

require_once "../database.php";

try {
    $statement = $conn->prepare("UPDATE publichealthworker SET exist = 0 WHERE publichealthworker.facilityID = :facilityID AND publichealthworker.employeeID");

    $statement->bindParam(":facilityID", $_GET["facilityID"]);

    $statement->bindParam(":employeeID", $_GET["employeeID"]);

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: index.php");
}