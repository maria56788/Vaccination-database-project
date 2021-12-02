<?php require_once "../database.php";

try {
   $statement = $conn->prepare("UPDATE approvedVaccines SET exist = 0 WHERE vaccineType = :vaccineType");

   $statement->bindParam(":vaccineType", $_GET["vaccineType"]);

   $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: index.php");
}