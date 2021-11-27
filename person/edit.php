<?php require_once '../database.php';
if (!isset($_GET["pID"])) {
    header("Location: index.php");
}

$mcnCheck = $conn->prepare("Select personID From cnc353_2.person_with_mcn WHERE personID = :pID");
$mcnCheck->bindParam(":pID", $_GET["pID"]);
$mcnCheck->execute();

if ($mcnCheck->rowCount() != 0) {
    $statement = $conn->prepare("SELECT pID, firstName, middleName, lastName, phone, citizenship, postalCode, email, city, address, DoB, province, groupAgeID, person_with_mcn.MCExpDate, person_with_mcn.MCIssueDate, person_with_mcn.MedicalCardNumber FROM cnc353_2.person
        Left JOIN cnc353_2.person_with_mcn ON person.pID = person_with_mcn.personID WHERE pID = :pID");

    $statement->bindParam(":pID", $_GET["pID"]);

    $statement->execute();

    $mcn = true;
} else {
    $statement = $conn->prepare("SELECT pID, firstName, middleName, lastName, phone, citizenship, postalCode, email, city, address, DoB, province, groupAgeID, person_with_passport.passportNumber  FROM cnc353_2.person
        Left JOIN cnc353_2.person_with_passport ON person.pID = person_with_passport.personID WHERE pID = :pID;");

    $statement->bindParam(":pID", $_GET["pID"]);

    $statement->execute();

    $mcn = false;
}


$person = $statement->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Edit person</title>
</head>
<body>
<div class="">
    <form action="./edit-query.php" method="post">
        <label for="pID"></label>pID<br>
        <input type="number" name="pID" id="pID" value="<?= $person["pID"] ?>" readonly><br>

        <label for="firstName"></label>firstName<br>
        <input type="text" name="firstName" id="firstName" value="<?= $person["firstName"] ?>"><br>

        <label for="middleName"></label>middleName<br>
        <input type="text" name="middleName" id="middleName" value="<?= $person["middleName"] ?>"><br>

        <label for="lastName"></label>lastName<br>
        <input type="text" name="lastName" id="lastName" value="<?= $person["lastName"] ?>"><br>

        <label for="phone"></label>phone<br>
        <input type="text" name="phone" id="phone" value="<?= $person["phone"] ?>"><br>

        <label for="citizenship"></label>citizenship<br>
        <input type="text" name="citizenship" id="citizenship" value="<?= $person["citizenship"] ?>"><br>

        <label for="postalCode"></label>postalCode<br>
        <input type="text" name="postalCode" id="postalCode" value="<?= $person["postalCode"] ?>"><br>

        <label for="email"></label>email<br>
        <input type="email" name="email" id="email" value="<?= $person["email"] ?>"><br>

        <label for="city"></label>city<br>
        <input type="text" name="city" id="city" value="<?= $person["city"] ?>"><br>

        <label for="address"></label>address<br>
        <input type="text" name="address" id="address" value="<?= $person["address"] ?>"><br>

        <label for="DoB"></label>DoB<br>
        <input type="date" name="DoB" id="DoB" value="<?= $person["DoB"] ?>"><br>

        <label for="province"></label>province<br>
        <input type="text" name="province" id="province" value="<?= $person["province"] ?>"><br>

        <label for="groupAgeID"></label>groupAgeID<br>
        <input type="number" name="groupAgeID" id="groupAgeID" value="<?= $person["groupAgeID"] ?>"><br>
        <?php if ($mcn == true) : ?>
            <label for="MCExpDate"></label>MCExpDate<br>
            <input type="Date" name="MCExpDate" id="MCExpDate" value="<?= $person["MCExpDate"] ?>"><br>
            <label for="MCIssueDate"></label>MCIssueDate<br>
            <input type="Date" name="MCIssueDate" id="MCIssueDate" value="<?= $person["MCIssueDate"] ?>"><br>
            <label for="MedicalCardNumber"></label>MedicalCardNumber<br>
            <input type="Text" name="MedicalCardNumber" id="MedicalCardNumber"
                   value="<?= $person["MedicalCardNumber"] ?>"><br>
        <?php else : ?>
            <label for="passportNumber"></label>passportNumber<br>
            <input type="Text" name="passportNumber" id="passportNumber" value="<?= $person["passportNumber"] ?>"><br>
        <?php endif; ?>
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
