<?php
require_once '../database.php';
try {

    $person = $conn->prepare("INSERT INTO person (pID, firstName, middleName, lastName, phone, citizenship, postalCode, email, city, address, DoB, province, groupAgeID)
    VALUES (:pID, :firstName, :middleName, :lastName, :phone, :citizenship, :postalCode, :email, :city, :address, :DoB, :province, :groupAgeID)");

    $person->bindParam(":pID",$_POST["pID"]);

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

    if(isset($_POST["passportNumber"])){
        $statement = $conn->prepare("INSERT INTO cnc353_2.person_with_passport (personID, passportNumber)
                                    VALUES (:pID,:passportNumber)");
        $statement->bindParam(":pID",$_POST["pID"]);

        $statement->bindParam(":passportNumber", $_POST["passportNumber"]);

        $statement->execute();

    }else{
        $statement = $conn->prepare("INSERT INTO cnc353_2.person_with_mcn (personID, MCExpDate, MCIssueDate, MedicalCardNumber)
                                    VALUES (:pID,:MCExpDate, :MCIssueDate , :MedicalCardNumber )");

        $statement->bindParam(":MCExpDate",$_POST["MCExpDate"]);

        $statement->bindParam(":MCIssueDate",$_POST["MCIssueDate"]);

        $statement->bindParam(":MedicalCardNumber",$_POST["MedicalCardNumber"]);

        $statement->bindParam(":pID",$_POST["pID"]);

        $statement->execute();
    }
    header("Location: index.php ");
    $conn = null;
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: create.php");
}