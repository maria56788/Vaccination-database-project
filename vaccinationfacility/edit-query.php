<?php
require_once '../database.php';
try {
    $statement = $conn->prepare("UPDATE vaccinationfacility SET fName = :fName, fType = :fType, phone = :phone, webAddress = :webAdress, capacity = :capacity, city = :city, province = :province, postalCode = :postalCode, address = :address , onlyAppoint = :onlyAppoint WHERE fID = :fID");

    $statement->bindParam(":fID", $_POST["fID"]);

    $statement->bindParam(":fName", $_POST["fName"]);

    $statement->bindParam(":fType", $_POST["fType"]);

    $statement->bindParam(":phone", $_POST["phone"]);

    $statement->bindParam(":webAddress", $_POST["webAddress"]);

    $statement->bindParam(":capacity", $_POST["capacity"]);

    $statement->bindParam(":city", $_POST["city"]);

    $statement->bindParam(":province", $_POST["province"]);

    $statement->bindParam(":postalCode", $_POST["postalCode"]);

    $statement->bindParam(":address", $_POST["address"]);

    $statement->bindParam(":onlyAppoint", $_POST["onlyAppoint"]);

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: edit.php?fID={$_POST["fID"]}");
}