<?php
require_once '../database.php';
try {
    $statement = $conn->prepare("UPDATE cnc353_2.publichealthworker SET personID =:personID, hourlyRate =:hourlyRate, jobType =:jobType, SSN = :SSN 
                                         WHERE employeeID = :employeeID AND facilityID = :facilityID");

    $statement->bindParam(":facilityID", $_POST["facilityID"]);

    $statement->bindParam(":personID", $_POST["personID"]);

    $statement->bindParam(":employeeID", $_POST["employeeID"]);

    $statement->bindParam(":hourlyRate", $_POST["hourlyRate"]);

    $statement->bindParam(":jobType", $_POST["jobType"]);

    $statement->bindParam(":SSN", $_POST["SSN"]);

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: edit.php?employeeID={$_POST['employeeID']}&facilityID={$_POST["facilityID"]}");
}