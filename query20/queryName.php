<?php
require_once "../database.php";
try {
    $persons = $conn->prepare('SELECT pID, firstName, middleName, lastName, DOB From cnc353_2.person
        WHERE firstName = :firstName AND middleName = :middleName AND lastName = :lastName');
    $persons->bindParam(":firstName", $_POST["firstName"]);
    if (!empty($_POST[":middleName"])) {
        $persons->bindParam(":middleName", $_POST["middleName"]);
    }else{
        $null = "NULL";
        $persons->bindParam(":middleName", $null);
    }
    $persons->bindParam(":middleName", $_POST["middleName"]);
    $persons->bindParam(":lastName", $_POST["lastName"]);
    $persons->execute();
    $person = $persons->fetch();
    $pID = $person["pID"];

    $bookings = $conn->prepare('SELECT booking.personID, booking.dayBooked, timeslot.startTime, vaccinationfacility.fName , vaccinationfacility.address, vaccinationfacility.city, vaccinationfacility.province, vaccinationfacility.postalCode
FROM ((booking
INNER JOIN timeslot on booking.timeID = timeslot.tID)
INNER JOIN vaccinationfacility on booking.facilityID = vaccinationfacility.fID)
WHERE booking.personID = :personID');
    $bookings->bindParam(":personID", $pID);
    $bookings->execute();


    $vaccines = $conn->prepare('SELECT a.vaccineTypeName, a.vaccineType, vaccination.lotNumberOfDose, vaccination.doseNumber, vaccination.date, 
                                            voc.locationVaccination foreignLocation, voc.countryVaccination foreignCountry, v.fName
FROM vaccination
INNER JOIN approvedvaccines a on vaccination.vType = a.vaccineType
LEFT JOIN vaccination_inside_country vic on vaccination.vID = vic.vaccinationID
LEFT JOIN vaccination_outside_country voc on vaccination.vID = voc.vaccinationID
LEFT JOIN vaccinationfacility v on vic.facilityID = v.fID
WHERE vaccination.pID = :personID
ORDER BY doseNumber asc');
    $vaccines->bindParam(":personID", $pID);
    $vaccines->execute();

    $infections = $conn->prepare("SELECT infection.infectedDate
FROM infection
WHERE infection.pID = :personID");
    $infections->bindParam(":personID", $pID);
    $infections->execute();

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
            <p>User information</p>
            <br>
            <p>Name: <?= $person["lastName"] . ", " . $person["firstName"] ?></p>
            <p>DOB: <?= $person["DOB"] ?></p>
        </div>

    </div>
    <hr>
    <?php foreach ($bookings

                   as $booking) { ?>
        <div class="row">
            <div class="col">
                <p>Appointment:</p>
                <p>Date: <?= $booking["dayBooked"] . " @ " . $booking["startTime"] ?></p>
                <p>Location: <?= $booking["fName"] ?></p>
                <p>
                    Address: <?= $booking["address"] . ", " . $booking["city"] . ", " . $booking["province"] . ", " . $booking["postalCode"] ?></p>
            </div>
        </div>
        <hr>
    <?php } ?>
    <?php foreach ($vaccines

                   as $vaccine) { ?>
        <div class="row">
            <div class="col">
                <p>Vaccine Administered Dose #<?= $vaccine["doseNumber"] ?></p>
                <br>
                <p>Name: <?= $vaccine["vaccineTypeName"] ?></p>
                <p>Code: <?= $vaccine["vaccineType"] ?></p>
                <p>Lot: <?= $vaccine["lotNumberOfDose"] ?></p>
                <p>Date: <?= $vaccine["date"] ?></p>
                <?php if (!empty($vaccine["foreignLocation"])) {
                    echo "<p>Location:    {$vaccine["foreignLocation"]}, {$vaccine["foreignCountry"]}</p>";
                } else {
                    echo "<p>Location:    {$vaccine["fName"]}</p>";
                }
                ?>
            </div>
        </div>
        <hr>
    <?php } ?>
    <?php foreach ($infections

                   as $infection) { ?>
        <div class="row">
            <div class="col">
                <p>Positive Covid-10 Diagnostic on <?= $infection["infectedDate"] ?></p>
            </div>
        </div>
    <?php } ?>
</div>
</body>
</html>