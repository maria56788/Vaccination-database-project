<?php

require_once "../database.php";

try {
    $statement = $conn->prepare("UPDATE cnc353_2.publichealthworker SET exist = 0 WHERE cnc353_2.publichealthworker.facilityID = :facilityID AND cnc353_2.publichealthworker.employeeID");

    $statement->bindParam(":facilityID", $_GET["facilityID"]);

    $statement->bindParam(":employeeID", $_GET["employeeID"]);

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: index.php");
}