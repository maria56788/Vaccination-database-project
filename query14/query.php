<?php
require_once "../database.php";
try {

    $facility = $conn->prepare("SELECT vaccinationfacility.fName , vaccinationfacility.address , vaccinationfacility.phone, vaccinationfacility.capacity, p.opens, p.closes
                                            FROM vaccinationfacility 
                                            INNER  JOIN weekShift ws ON ws.facilityID = vaccinationfacility.fID
                                            INNER  JOIN patterns p on ws.patternID = p.patternID
                                            WHERE  fID NOT IN(SELECT publichealthworker.facilityID
    FROM publichealthworker
    INNER JOIN person p on publichealthworker.personID = p.pID
    INNER JOIN history h on publichealthworker.employeeID = h.employeeID AND publichealthworker.facilityID = h.facilityID
    WHERE publichealthworker.exist = 1
    AND publichealthworker.facilityID = h.facilityID
    AND IF(h.endDate IS NULL,IF(Date(:date) > h.startDate,1,0),IF(:date BETWEEN h.startDate AND h.endDate,1,0)) = 1
    AND publichealthworker.jobType = 'nurse')");
    $facility->bindParam(":date",$_POST["date"]);
    $facility->execute();



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
    <table class="striped">
        <h3>List of Facility with no nurses on <?=$_POST["date"]?></h3>
        <thead>
            <tr>
                <td>Facility Name</td>
                <td>Address</td>
                <td>Phone</td>
                <td>Capacity</td>
                <td>Opens At</td>
                <td>Closes At</td>

            </tr>
        </thead>
        <tbody>
        <?php foreach ($facility as $facilityInfo) { ?>
            <tr>
                <td><?= $facilityInfo["fName"] ?></td>
                <td><?= $facilityInfo["address"] ?></td>
                <td><?= $facilityInfo["phone"] ?></td>
                <td><?= $facilityInfo["capacity"] ?></td>
                <td><?= $facilityInfo["opens"] ?></td>
                <td><?= $facilityInfo["closes"] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php foreach ($facility as $facilityInfo) { ?>
    <div class="row">
        <div class="col">
            <p><?=$facilityInfo["fName"]."  ".$facilityInfo["address"]." ".$facilityInfo["phone"]." ".$facilityInfo["capacity"]." information on the date of ".$_POST["date"]?></p>
            <br>
            <p>Opens: <?=$facilityInfo["opens"]?> </p>
            <p>Closes: <?= $facilityInfo["closes"] ?></p>
        </div>
        <hr>

    </div>
        tr
    <?php } ?>
</div>
</body>
</html>