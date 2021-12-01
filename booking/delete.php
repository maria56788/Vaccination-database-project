<?php

require_once "../database.php";

try {
    $statement = $conn->prepare("UPDATE booking SET exist = 0 WHERE personID = :personID AND facilityID = :facilityID AND dayBooked =:dayBooked");

    $statement->bindParam(":facilityID", $_GET["facilityID"]);

    $statement->bindParam(":personID", $_GET["personID"]);

    $statement->bindParam(":dayBooked", $_GET["dayBooked"]);

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: index.php");
}