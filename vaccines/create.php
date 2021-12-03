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
    <title>Create a vaccination</title>
</head>
<body>
    <form action="create-query.php" method="post">
        <label for="firstName"></label>First Name<br>
        <input type="text" name="firstName" id="firstName"><br>

        <label for="middleName"></label>Middle Name<br>
        <input type="text" name="middleName" id="middleName"><br>

        <label for="lastName"></label>Last Name<br>
        <input type="text" name="lastName" id="lastName"><br>

        <label for="facilityID"></label>Facility ID<br>
        <input type="number" name="facilityID" id="facilityID"><br>

        <label for="vID"></label>vID<br>
        <input type="number" name="vID" id="vID"><br>

        <label for="doseNumber">doseNumber</label><br>
        <input type="number" name="doseNumber" id="doseNumber"><br>

        <label for="lotNumberOfDose">lotNumberOfDose</label><br>
        <input type="number" name="lotNumberOfDoser" id="lotNumberOfDose"><br>
        
        <label for="vType"></label>vaccination type<br>
        <input type="text" name="vType" id="vType"><br>

        <label for="timeID"></label>timeID<br>
        <input type="number" name="timeID" id="timeID"><br>

        <label for="dayBooked"></label>Date Booked<br>
        <input type="text" name="dayBooked" id="dayBooked"><br>

        <label for="nurseID"></label>Nurse ID <br>
        <input type="number" name="nurseID" id="nurseID"><br>

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