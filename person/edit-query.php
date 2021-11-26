<?php
require_once '../database.php';
try {
    $statement = $conn->prepare("UPDATE cnc353_2.person
                                    SET
                                         firstName = :firstName, 
                                         middleName =:middleName, 
                                         lastName =:lastName, 
                                         phone =:phone,
                                         citizenship =:citizenship,
                                         postalCode =:postalCode,
                                         email =:email,
                                         city =:city,
                                         address =:address,
                                         DoB =:DoB,
                                         province =:province,
                                         groupAgeID =:groupAgeID
                                         WHERE pID = :pID");

    $statement->bindParam(":pID", $_POST["pID"]);

    $statement->bindParam(":firstName", $_POST["firstName"]);

    $statement->bindParam(":middleName", $_POST["middleName"]);

    $statement->bindParam(":lastName", $_POST["lastName"]);

    $statement->bindParam(":phone", $_POST["phone"]);

    $statement->bindParam(":citizenship", $_POST["citizenship"]);

    $statement->bindParam(":postalCode", $_POST["postalCode"]);

    $statement->bindParam(":email", $_POST["email"]);

    $statement->bindParam(":city", $_POST["city"]);

    $statement->bindParam(":address", $_POST["address"]);

    $statement->bindParam(":DoB", $_POST["DoB"]);

    $statement->bindParam(":province", $_POST["province"]);

    $statement->bindParam(":groupAgeID", $_POST["groupAgeID"]);

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: edit.php?pID={$_POST["pID"]}");
}