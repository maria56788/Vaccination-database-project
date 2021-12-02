<?php require_once '../database.php';
if (!isset($_GET["employeeID"])){
    header("Location: index.php");
}
$statement = $conn->prepare("SELECT * FROM cnc353_2.publichealthworker WHERE employeeID = :employeeID  ");

$statement->bindParam(":employeeID",$_GET["employeeID"]);




$statement->execute();

$publichealthworker = $statement->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Edit publichealthworker</title>
</head>
<body>
    <form action="./edit-query.php" method="post">
        
    <label for="firstName">firstName</label><br>
        <input type="text" name="firstName" id="firstName" value="<?= $publichealthworker["firstName"]?>" readonly><br>

        <label for="middleName">middleName</label><br>
        <input type="text" name="middleName" id="middleName" value="<?= $publichealthworker["middleName"]?>" readonly><br>

        <label for="lastName">lastName</label><br>
        <input type="text" name="lastName" id="lastName" value="<?= $publichealthworker["lastName"]?>" readonly><br>

        <label for="employeeID"></label>employeeID<br>
        <input type="number" name="employeeID" id="employeID" value="<?= $publichealthworker["employeeID"]?>" readonly><br>

        <label for="startShift"></label>startShift<br>
        <input type="time" name="startShift" id="startShift" value="<?= $publichealthworker["timeID"]?>"><br>
        
        <label for="endShift"></label>endShift<br>
        <input type="time" name="endShift" id="endShift" value="<?= $publichealthworker["endShift"]?>"><br>

        <label for="facilityID">facilityID</label><br>
        <input type="number" name="facilityID" id="facilityID" value="<?= $publichealthworker["facilityID"]?>" readonly><br>


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
