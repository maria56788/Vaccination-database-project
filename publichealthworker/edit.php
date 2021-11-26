<?php require_once '../database.php';
if (!isset($_GET["employeeID"])&&!isset($_GET["facilityID"])){
    header("Location: index.php");
}
$statement = $conn->prepare("SELECT * FROM cnc353_2.publichealthworker WHERE facilityID = :facilityID AND employeeID = :employeeID");

$statement->bindParam(":employeeID",$_GET["employeeID"]);

$statement->bindParam(":facilityID",$_GET["facilityID"]);

$statement->execute();

$publichealthworker = $statement->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Publichealthworker</title>
</head>
<body>
    <form action="./edit-query.php" method="post">
        <label for="facilityID"></label>facilityID<br>
        <input type="number" name="facilityID" id="facilityID" value="<?= $publichealthworker["facilityID"]?>"><br>
        
        <label for="personID"></label>personID<br>
        <input type="number" name="personID" id="personID" value="<?= $publichealthworker["personID"]?>"><br>

        <label for="employeeID"></label>employeeID<br>
        <input type="number" name="employeeID" id="employeeID" value="<?= $publichealthworker["employeeID"]?>"><br>
        
        <label for="hourlyRate"></label>hourlyRate<br>
        <input type="number" name="hourlyRate" id="hourlyRate" value="<?= $publichealthworker["hourlyRate"]?>"><br>

        <label for="jobType"></label>jobType<br>
        <input type="text" name="jobType" id="jobType" value="<?= $publichealthworker["jobType"]?>"><br>

        <label for="SSN">SSN</label><br>
        <input type="text" name="SSN" id="SSN" value="<?= $publichealthworker["SSN"]?>"><br>

        <button type="submit">Update</button>
       
    </form>
    <?php
    if (isset($_SESSION["errorMSG"])) {
        echo $_SESSION["errorMSG"];
        unset($_SESSION["errorMSG"]);
    }
    ?>
</body>
</html>
