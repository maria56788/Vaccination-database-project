<?php

require_once "../database.php";

try {
    $statement = $conn->prepare("UPDATE cnc353_2.vaccinationfacility SET exist = 0 WHERE vaccinationfacility.fID = :fID ");

    $statement->bindParam(":fID", $_GET["fID"]);


    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: index.php");
}