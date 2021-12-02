<?php
require_once "../database.php";
try {


    $facilityInfo = $facility->fetch();
    $nurses = $conn->prepare("SELECT publichealthworker.employeeID, person.firstName,person.lastName,person.email, publichealthworker.hourlyRate 
    FROM publichealthworker
    inner join person on publichealthworker.personID=person.pID
    where publichealthworker.employeeID NOT IN 
        (SELECT p.pID
        FROM publichealthworker
        INNER JOIN person p on publichealthworker.personID = p.pID
        INNER JOIN history h on publichealthworker.employeeID = h.employeeID AND publichealthworker.facilityID = h.facilityID
        WHERE publichealthworker.exist = 1
        AND publichealthworker.facilityID = :facilityID
        AND publichealthworker.jobType = 'nurse')
    AND publichealthworker.jobType = 'nurse';;
");
    $nurses->bindParam(":facilityID", $_POST["facilityID"]);
    $nurses->bindParam(":date", $_POST["date"]);
    $nurses->execute();


}
 catch (PDOException $e) {
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


    </div>
    <hr>
    <p>Nurses:</p>
    <?php foreach ($nurses

                   as $nurse) { ?>
        <div class="row">
            <div class="col s6">
                <p>Information: <?= $nurse["employeeID"]." ".$nurse["firstName"]." ".$nurse["lastName"]."".$nurse["hourlyWage"]." ".$nurse["lastName"]?></p>
                
            </div>
        </div>
        

    <?php } ?>
   
    <?php  ?>
</div>
</body>
</html>