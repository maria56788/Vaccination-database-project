<?php

require_once "../database.php";

try {
    $statement = $conn->prepare("UPDATE cnc353_2.person SET exist = 0 WHERE pID = :pID");

    $statement->bindParam(":pID", $_GET["pID"]);

    $statement->execute();

    $statement = $conn->prepare("UPDATE cnc353_2.person_with_mcn SET exist = 0 WHERE person_with_mcn.personID = :pID");

    $statement->bindParam(":pID", $_GET["pID"]);

    $statement->execute();

    $statement = $conn->prepare("UPDATE cnc353_2.person_with_passport SET exist = 0 WHERE cnc353_2.person_with_passport.personID = :pID");

    $statement->bindParam(":pID", $_GET["pID"]);

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: index.php");
}