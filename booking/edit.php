<?php require_once '../database.php';
if (!isset($_GET["personID"])&&!isset($_GET["facilityID"])){
    header("Location: index.php");
}
$statement = $conn->prepare("SELECT * FROM cnc353_2.booking WHERE facilityID = :facilityID AND personID = :personID AND dayBooked = :dayBooked");

$statement->bindParam(":personID",$_GET["personID"]);

$statement->bindParam(":facilityID",$_GET["facilityID"]);

$statement->bindParam(":dayBooked",$_GET["dayBooked"]);

$statement->execute();

$booking = $statement->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Edit booking</title>
</head>
<body>
    <form action="./edit-query.php" method="post">
        <label for="facilityID">facilityID</label><br>
        <input type="number" name="facilityID" id="facilityID" value="<?= $booking["facilityID"]?>" readonly><br>

        <label for="personID"></label>personID<br>
        <input type="number" name="personID" id="personID" value="<?= $booking["personID"]?>" readonly><br>

        <label for="timeID"></label>timeID<br>
        <input type="text" name="timeID" id="timeID" value="<?= $booking["timeID"]?>"><br>
        
        <label for="dayBooked"></label>dayBooked<br>
        <input type="number" name="dayBooked" id="dayBooked" value="<?= $booking["dayBooked"]?>"><br>

        

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
