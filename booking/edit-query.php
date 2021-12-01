<?php
require_once '../database.php';
try {
    $statement = $conn->prepare("UPDATE cnc353_2.booking SET facilityID = :facilityID, personID =:personID, timeID=:timeID, dayBooked =:dayBooked
                                         WHERE personID = :personID AND facilityID = :facilityID AND dayBooked =:dayBooked");

    $statement->bindParam(":facilityID", $_POST["facilityID"]);

    $statement->bindParam(":personID", $_POST["personID"]);

    $statement->bindParam(":timeID", $_POST["timeID"]);

    $statement->bindParam(":dayBooked", $_POST["dayBooked"]);

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: edit.php?employeeID={$_POST['employeeID']}&facilityID={$_POST["facilityID"]}");
}