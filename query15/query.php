<?php
require_once "../database.php";
try {

    $facility = $conn->prepare('SELECT ws.workDays, p.opens, p.closes, vaccinationfacility.fName
                                        FROM vaccinationfacility
                                        INNER  JOIN weekShift ws ON ws.facilityID = vaccinationfacility.fID
                                        INNER  JOIN patterns p on ws.patternID = p.patternID
                                        WHERE fID = :facilityID');
    $facility->bindParam(":facilityID",$_POST["facilityID"]);
    $facility->execute();
    if ($facility->rowCount() != 1){
        throw new PDOException;
    }

    $facilityInfo = $facility->fetch();
    $nurses = $conn->prepare("SELECT p.firstName, p.middleName, p.lastName , h.startShift, h.endShift
FROM publichealthworker
INNER JOIN person p on publichealthworker.personID = p.pID
INNER JOIN history h on publichealthworker.employeeID = h.employeeID AND publichealthworker.facilityID = h.facilityID
WHERE publichealthworker.exist = 1
AND publichealthworker.facilityID = :facilityID
AND IF(h.endDate IS NULL,IF(:date > h.startDate,1,0),IF(:date BETWEEN h.startDate AND h.endDate,1,0)) = 1
AND publichealthworker.jobType = 'nurse';
");
    $nurses->bindParam(":facilityID", $_POST["facilityID"]);
    $nurses->bindParam(":date", $_POST["date"]);
    $nurses->execute();

    $workers = $conn->prepare("SELECT p.firstName, p.middleName, p.lastName , h.startShift, h.endShift, publichealthworker.jobType
FROM publichealthworker
INNER JOIN person p on publichealthworker.personID = p.pID
INNER JOIN history h on publichealthworker.employeeID = h.employeeID AND publichealthworker.facilityID = h.facilityID
WHERE publichealthworker.exist = 1
AND publichealthworker.facilityID = :facilityID
AND IF(h.endDate IS NULL,IF(:date > h.startDate,1,0),IF(:date BETWEEN h.startDate AND h.endDate,1,0)) = 1
AND publichealthworker.jobType <> 'nurse';
");
    $workers->bindParam(":facilityID", $_POST["facilityID"]);
    $workers->bindParam(":date", $_POST["date"]);
    $workers->execute();

    $persons = $conn->prepare("SELECT person.firstName, person.middleName, person.lastName, t.startTime
    FROM person
    INNER JOIN booking b on person.pID = b.personID
    INNER JOIN timeslot t on b.timeID = t.tID
    WHERE b.facilityID = :facilityID
    AND b.dayBooked = :date");
    $persons->bindParam(":facilityID", $_POST["facilityID"]);
    $persons->bindParam(":date", $_POST["date"]);
    $persons->execute();
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Person Information</title>
</head>
<body>
<div class="Output">
    <div class="row">
        <div class="col s6">
            <p>Health and Social Services</p>
        </div>
        <div class="col s6">
            <p>Proof of Vaccination against COVID-19</p>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col">
            <p><?=$facilityInfo["fName"]." information on the date of ".$_POST["date"]?></p>
            <br>
            <p>Opens: <?=$facilityInfo["opens"]?> </p>
            <p>Closes: <?= $facilityInfo["closes"] ?></p>
        </div>

    </div>
    <hr>
    <p>Nurses:</p>
    <?php foreach ($nurses

                   as $nurse) { ?>
        <div class="row">
            <div class="col s6">
                <p>Name: <?= $nurse["firstName"]." ".$nurse["middleName"]." ".$nurse["lastName"]?></p>
                <p>Schedule From <?= $nurse["startShift"] . " To " . $nurse["endShift"] ?></p>
            </div>
        </div>
        <hr>
    <?php } ?>
    <p>Workers:</p>
    <?php foreach ($workers

                   as $worker) { ?>
        <div class="row">
            <div class="col s6">
                <p>Name: <?= $worker["firstName"]." ".$worker["middleName"]." ".$worker["lastName"]?></p>
                <p>Work Type <?= $worker["jobType"]?></p>
                <p>Schedule From <?= $worker["startShift"] . " To " . $worker["endShift"] ?></p>
            </div>
        </div>
        <hr>
    <?php } ?>
    <p>Appointments</p>
    <?php foreach ($persons

                   as $person) { ?>
        <div class="row">
            <div class="col s6">
                <p>Name: <?= $person["firstName"]." ".$person["middleName"]." ".$person["lastName"]?></p>
                <p>At: <?= $person["startTime"]?></p>
            </div>
        </div>
    <?php } ?>
</div>
</body>
</html>