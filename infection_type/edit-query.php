<?php
require_once '../database.php';
try {
    $statement = $conn->prepare("UPDATE cnc353_2.infection_type SET infectionName = :infectionName WHERE infID = :infID");

    $statement->bindParam(":infID", $_POST["infID"]);

    $statement->bindParam(":infectionName", $_POST["infectionName"]);

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: edit.php?infID={$_POST["infID"]}");
}