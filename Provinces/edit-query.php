<?php
require_once '../database.php';
try {
    $statement = $conn->prepare("UPDATE province SET ageGroupID = :ageGroupID WHERE province = :province");

    $statement->bindParam(":province", $_POST["province"]);

    $statement->bindParam(":ageGroupID", $_POST["ageGroupID"]);

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: edit.php?province={$_POST["province"]}");
}