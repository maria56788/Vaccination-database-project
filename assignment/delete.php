<?php

require_once "../database.php";

try {
    $statement = $conn->prepare("UPDATE publichealthworker SET exist = 0 WHERE employeeID = :employeeID AND facilityID = :facilityID ");

    $statement->bindParam(":facilityID", $_GET["facilityID"]);

    $statement->bindParam(":employeeID", $_GET["employeeID"]);

  

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: index.php");
}