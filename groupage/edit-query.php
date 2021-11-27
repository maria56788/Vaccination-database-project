<?php
require_once '../database.php';
try {
    $statement = $conn->prepare("UPDATE cnc353_2.groupage
                                     SET  
                                         ageMax = :ageMax, 
                                         ageMin =:ageMin
                                     WHERE gID = :gID");

    $statement->bindParam(":gID",$_POST["gID"]);

    $statement->bindParam(":ageMax",$_POST["ageMax"]);

    $statement->bindParam(":ageMin",$_POST["ageMin"]);

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: edit.php?gID={$_POST["gID"]}");
}