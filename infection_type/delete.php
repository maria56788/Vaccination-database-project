<?php

require_once "../database.php";

try {
    $statement = $conn->prepare("UPDATE infection_type SET exist = 0 WHERE infID = :infID");

    $statement->bindParam(":infID", $_GET["infID"]);

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: index.php");
}