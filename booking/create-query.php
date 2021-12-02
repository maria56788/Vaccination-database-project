<?php
require_once '../database.php';
try {
    $booking = $conn->prepare("INSERT INTO cnc353_2.booking (facilityID, personID, timeID, dayBooked)
    VALUES (:facilityID, :personID, :timeID, :dayBooked)");

    $booking->bindParam(":facilityID",$_POST["facilityID"]);

    $booking->bindParam(":personID",$_POST["personID"]);

    $booking->bindParam(":timeID",$_POST["timeID"]);

    $booking->bindParam(":dayBooked",$_POST["dayBooked"]);

    $booking->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: create.php");
}