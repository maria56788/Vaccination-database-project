<?php
require_once "../database.php";
try {

    $facility = $conn->prepare('SELECT vaccinationfacility.fName , vaccinationfacility.address , vaccinationfacility.phone, vaccinationfacility.capacity, p.opens, p.closes
                                            FROM vaccinationfacility 
                                            INNER  JOIN weekShift ws ON ws.facilityID = vaccinationfacility.fID
                                            INNER  JOIN patterns p on ws.patternID = p.patternID
                                            WHERE fID = facilityID
                                            and not exists (SELECT publichealthworker.facilityID
    FROM publichealthworker
    INNER JOIN person p on publichealthworker.personID = p.pID
    INNER JOIN history h on publichealthworker.employeeID = h.employeeID AND publichealthworker.facilityID = h.facilityID
    WHERE publichealthworker.exist = 1
    AND publichealthworker.facilityID = h.facilityID
    #AND IF(h.endDate IS NULL,IF(:date > h.startDate,1,0),IF(:date BETWEEN h.startDate AND h.endDate,1,0)) = 1
    AND publichealthworker.jobType = "nurse")');
    $facility->bindParam(":facilityID",$_POST["facilityID"]);
    $facility->execute();
    if ($facility->rowCount() != 1){
        throw new PDOException;
    }

    $facilityInfo = $facility->fetch();
   

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
            <p><?=$facilityInfo["fName"]."  ".$facilityInfo["address"]." ".$facilityInfo["phone"]." ".$facilityInfo["capacity"]." information on the date of ".$_POST["date"]?></p>
            <br>
            <p>Opens: <?=$facilityInfo["opens"]?> </p>
            <p>Closes: <?= $facilityInfo["closes"] ?></p>
        </div>

    </div>
    
</div>
</body>
</html>