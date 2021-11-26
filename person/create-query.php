<?php
require_once '../database.php';
try {

    $person = $conn->prepare("INSERT INTO cnc353_2.person (firstName, middleName, lastName, phone, citizenship, postalCode, email, city, address, DoB, province, groupAgeID)
    VALUES (:firstName, :middleName, :lastName, :phone, :citizenship, :postalCode, :email, :city, :address, :DoB, :province, :groupAgeID)");

    $person->bindParam(":firstName",$_POST["firstName"]);

    $person->bindParam(":middleName",$_POST["middleName"]);

    $person->bindParam(":lastName",$_POST["lastName"]);

    $person->bindParam(":phone",$_POST["phone"]);

    $person->bindParam(":citizenship",$_POST["citizenship"]);

    $person->bindParam(":postalCode",$_POST["postalCode"]);

    $person->bindParam(":email",$_POST["email"]);

    $person->bindParam(":city",$_POST["city"]);

    $person->bindParam(":address",$_POST["address"]);

    $person->bindParam(":DoB",$_POST["DoB"]);

    $person->bindParam(":province",$_POST["province"]);

    $person->bindParam(":groupAgeID",$_POST["groupAgeID"]);

    $person->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: create.php");
}