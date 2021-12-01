<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Vaccine Facility</title>
</head>
<body>
<form action="./create-query.php" method="post">
    <label for="fID">Facility  ID</label><br>
    <input type="number" name="fID" id="fID"><br>

    <label for="fName">Facility Name</label><br>
    <input type="text" name="fName" id="fName"><br>

    <label for="fType">Facility Type</label><br>
    <input type="text" name="fName" id="fName"><br>

    <label for="phone">Phone</label><br>
    <input type="text" name="phone" id="phone"><br>

    <label for="webAddress">webAddress</label><br>
    <input type="text" name="webAddress" id="webAddress"><br>

    <label for="capacity">Capacity</label><br>
    <input type="number" name="capacity" id="capacity"><br>

    <label for="city">City</label><br>
    <input type="text" name="city" id="city"><br>

    <label for="province">Province</label><br>
    <input type="text" name="province" id="province"><br>

    <button type="submit">Create</button>
    <?php
    if (isset($_SESSION["errorMSG"])) {
        echo $_SESSION["errorMSG"];
        unset($_SESSION["errorMSG"]);
    }
    ?>
</form>
</body>
</html>