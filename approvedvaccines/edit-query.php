<?php
require_once '../database.php';
try {
    $statement = $conn->prepare("UPDATE cnc353_2.approvedvaccines
                                     SET  
                                         dateOfApproval = :dateOfApproval, 
                                         vDesc =:vDesc, 
                                         vStatus =:vStatus, 
                                         suspendedDate =:suspendedDate
                                     WHERE vaccineType =:vaccineType");

    $statement->bindParam(":vaccineType",$_POST["vaccineType"]);

    $statement->bindParam(":dateOfApproval",$_POST["dateOfApproval"]);

    $statement->bindParam(":vDesc",$_POST["vDesc"]);

    $statement->bindParam(":vStatus",$_POST["vStatus"]);
    if (!empty($_POST["suspendedDate"])) {
        $statement->bindParam(":suspendedDate",$_POST["suspendedDate"]);
    }else{
        $null = "NULL";
        $statement->bindParam(":suspendedDate",$null);

    }


    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: edit.php?vaccineType={$_POST["vaccineType"]}");
}