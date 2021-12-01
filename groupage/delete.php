<?php

require_once "../database.php";

try {
    $statement = $conn->prepare("UPDATE groupage SET exist = 0 WHERE gID = :gID");

    $statement->bindParam(":gID", $_GET["gID"]);

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: index.php");
}