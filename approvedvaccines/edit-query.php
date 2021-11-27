<?php
require_once '../database.php';
try {
    $statement = $conn->prepare("UPDATE cnc353_2.approvedvaccines
    SET vaccineType =:vaccineType, 
        dateOfApproval = :dateOfApproval, 
        vDesc =:vDesc, 
        vStatus =:vStatus, 
        suspendedDate =:suspendedDate");

$statement->bindParam(":vaccineType",$_POST["vaccineType"]);

$statement->bindParam(":dateOfApproval",$_POST["dateOfApproval"]);

$statement->bindParam(":vDesc",$_POST["vDesc"]);

$statement->bindParam(":vStatus",$_POST["vStatus"]);

$statement->bindParam(":suspendedDate",$_POST["suspendedDate"]);

$statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: edit.php?pID={$_POST["pID"]}");
}