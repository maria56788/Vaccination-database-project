<?php
require_once '../database.php';
try {
    $statement = $conn->prepare("INSERT INTO cnc353_2.vaccinationfacility (fID, fName, fType, phone, webAddress, capacity, city, province, postalCode, address) VALUES (:fID, :fName, :fType, :phone, :webAddress, :capacity, :city, :province, :postalCode,:address)");

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
    $statement->execute();


    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: create.php");
}