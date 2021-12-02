<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Create a Person</title>
</head>
<body>
<form action='create-query.php' method="post">

    <label for="pID"></label>pID<br>
    <input type="number" name="pID" id="pID" ><br>

    <label for="firstName"></label>firstName<br>
    <input type="text" name="firstName" id="firstName" ><br>

    <label for="middleName"></label>middleName<br>
    <input type="text" name="middleName" id="middleName" ><br>

    <label for="lastName"></label>lastName<br>
    <input type="text" name="lastName" id="lastName" ><br>

    <label for="phone"></label>phone<br>
    <input type="number" name="phone" id="phone" ><br>

    <label for="citizenship"></label>citizenship<br>
    <input type="text" name="citizenship" id="citizenship" ><br>

    <label for="postalCode"></label>postalCode<br>
    <input type="text" name="postalCode" id="postalCode" ><br>

    <label for="email"></label>email<br>
    <input type="email" name="email" id="email" ><br>

    <label for="city"></label>city<br>
    <input type="text" name="city" id="city" value=""><br>

    <label for="address"></label>address<br>
    <input type="text" name="address" id="address" value=""><br>

    <label for="DoB"></label>DoB<br>
    <input type="date" name="DoB" id="DoB" value=""><br>

    <label for="province"></label>province<br>
    <input type="text" name="province" id="province" value=""><br>

    <label for="groupAgeID"></label>groupAgeID<br>
    <input type="number" name="groupAgeID" id="groupAgeID" value=""><br>
    <?php if ($_GET["mcn"] == 1) : ?>
        <label for="MCExpDate"></label>MCExpDate<br>
        <input type="Date" name="MCExpDate" id="MCExpDate" value=""><br>
        <label for="MCIssueDate"></label>MCIssueDate<br>
        <input type="Date" name="MCIssueDate" id="MCIssueDate" value=""><br>
        <label for="MedicalCardNumber"></label>MedicalCardNumber<br>
        <input type="Text" name="MedicalCardNumber" id="MedicalCardNumber" value=""><br>
    <?php else : ?>
        <label for="passportNumber"></label>passportNumber<br>
        <input type="Text" name="passportNumber" id="passportNumber" value=""><br>
    <?php endif; ?>
    <input type="submit" value="Create">

</form>
<?php
if (isset($_SESSION["errorMSG"])) {
    echo $_SESSION["errorMSG"];
    unset($_SESSION["errorMSG"]);
}
?>
</body>
</html>
