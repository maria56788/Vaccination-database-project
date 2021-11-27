<?php
require_once '../database.php';
try {
    if (!empty($_POST["suspendedDate"])) {
        $approvedvaccines = $conn->prepare("INSERT INTO cnc353_2.approvedvaccines (vaccineType, dateOfApproval, vDesc, vStatus, suspendedDate)
    VALUES (:vaccineType, :dateOfApproval, :vDesc, :vStatus, :suspendedDate);");

        $approvedvaccines->bindParam(":vaccineType", $_POST["vaccineType"]);

        $approvedvaccines->bindParam(":dateOfApproval", $_POST["dateOfApproval"]);

        $approvedvaccines->bindParam(":vDesc", $_POST["vDesc"]);

        $approvedvaccines->bindParam(":vStatus", $_POST["vStatus"]);

        $approvedvaccines->bindParam(":suspendedDate", $_POST["suspendedDate"]);
    } else {
        $approvedvaccines = $conn->prepare("INSERT INTO cnc353_2.approvedvaccines (vaccineType, dateOfApproval, vDesc, vStatus)
    VALUES (:vaccineType, :dateOfApproval, :vDesc, :vStatus);");

        $approvedvaccines->bindParam(":vaccineType", $_POST["vaccineType"]);

        $approvedvaccines->bindParam(":dateOfApproval", $_POST["dateOfApproval"]);

        $approvedvaccines->bindParam(":vDesc", $_POST["vDesc"]);

        $approvedvaccines->bindParam(":vStatus", $_POST["vStatus"]);

    }

    $approvedvaccines->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: create.php");
}