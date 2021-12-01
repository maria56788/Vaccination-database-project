<?php require_once '../database.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Create a booking</title>
</head>
<body>
    <form action="./create-query.php" method="post">
        <label for="facilityID"></label>facilityID<br>
        <input type="number" name="facilityID" id="facilityID"><br>

        

        <label for="personID"></label>personID<br>
        <input type="number" name="personID" id="personID"><br>

        <label for="timeID"></label>timeID<br>
        <input type="number" name="timeID" id="timeID"><br>

        <label for="dayBooked"></label>dayBooked<br>
        <input type="text" name="dayBooked" id="dayBooked"><br>

        <button type="submit">Create</button>

    </form>
    <?php
    if (isset($_SESSION["errorMSG"])) {
        echo $_SESSION["errorMSG"];
        unset($_SESSION["errorMSG"]);
    }
    ?>
</body>
</html>