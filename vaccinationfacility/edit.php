<?php require_once '../database.php';
if (!isset($_GET["fID"])){
    header("Location: index.php");
}

$statement = $conn->prepare("SELECT * FROM cnc353_2.vaccinationfacility WHERE fID = :fID");

$statement->bindParam(":fID", $_GET["fID"]);

$statement->execute();

$facility = $statement->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Edit provinces</title>
</head>
<body>
<form action="./edit-query.php" method="post">
    <label for="fID">Facility  ID</label><br>
    <input type="number" name="fID" id="fID" value="<?=$facility["fID"]?>" readonly><br>

    <label for="fName">Facility Name</label><br>
    <input type="text" name="fName" id="fName"  value="<?=$facility["fName"]?>"><br>

    <label for="fType">Facility Type</label><br>
    <input type="text" name="fType" id="fType" value="<?=$facility["fType"]?>"><br>

    <label for="phone">Phone</label><br>
    <input type="text" name="phone" id="phone" value="<?=$facility["phone"]?>"><br>

    <label for="webAddress">webAddress</label><br>
    <input type="text" name="webAddress" id="webAddress" value="<?=$facility["webAddress"]?>"><br>

    <label for="capacity">Capacity</label><br>
    <input type="number" name="capacity" id="capacity" value="<?=$facility["capacity"]?>"><br>

    <label for="city">City</label><br>
    <input type="text" name="city" id="city" value="<?=$facility["city"]?>"><br>

    <label for="province">Province</label><br>
    <input type="text" name="province" id="province" value="<?=$facility["province"]?>"><br>

    <label for="postalCode">Postal Code</label><br>
    <input type="text" name="postalCode" id="postalCode" value="<?=$facility["postalCode"]?>"><br>

    <label for="address">Address</label><br>
    <input type="text" name="address" id="address" value="<?=$facility["address"]?>"><br>

    <label for="onlyAppoint">Only Appointment</label><br>
    <input type="number" name="onlyAppoint" id="onlyAppoint" value="<?=$facility["onlyAppoint"]?>"><br>

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


