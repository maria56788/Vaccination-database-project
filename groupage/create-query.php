<?php
require_once '../database.php';
try {
    $groupage = $conn->prepare("INSERT INTO cnc353_2.groupage (gID, ageMax, ageMin)
    VALUES (:gID, :ageMax, :ageMin)");

    $groupage->bindParam(":gID",$_POST["gID"]);

    $groupage->bindParam(":ageMax",$_POST["ageMax"]);

    $groupage->bindParam(":ageMin",$_POST["ageMin"]);

    $groupage->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: create.php");
}