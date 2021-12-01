<?php
require_once "../database.php";
try {
    $statement = $conn->query("SELECT
    vaccinationfacility.fName AS Name,
    vaccinationfacility.webAddress AS Address,
    vaccinationfacility.fType AS Type,
    vaccinationfacility.phone AS Phone,
    vaccinationfacility.capacity AS capacity,
    COUNT(DISTINCT p.personID) AS totalPHW,
    COUNT(distinct vaccinationID) AS FacilityTotalDoses,
    l.FutureDoses
FROM
     (((vaccinationfacility
    INNER JOIN publichealthworker p on vaccinationfacility.fID = p.facilityID)
    INNER JOIN vaccination_inside_country vic on vaccinationfacility.fID = vic.facilityID)
    INNER JOIN (SELECT fID, COUNT(b.personID) as FutureDoses
        FROM vaccinationfacility
        INNER JOIN booking b on vaccinationfacility.fID = b.facilityID
        GROUP BY fID) AS l ON l.fID = vaccinationfacility.fID)

WHERE
   vaccinationfacility.city = 'Montreal'
GROUP BY vaccinationfacility.fname
ORDER BY FacilityTotalDoses ASC
");

}catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
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
    <title>Facility Report</title>
</head>
<body>
<?php if (isset($statement)) {
    foreach ($statement as $row) { ?>
        <div class="row">
            <div class="col s12 ">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title"><?=$row["Name"]?></span>
                        <p>Web address: <?=$row["Address"]?></p>
                        <p>Type: <?=$row["Type"]?></p>
                        <p>Phone: <?=$row["Phone"]?></p>
                        <p>capacity: <?=$row["capacity"]?></p>
                        <p>Total Public Health Workers: <?=$row["totalPHW"]?></p>
                        <p>Total Doses Given: <?=$row["FacilityTotalDoses"]?></p>
                        <p>Vaccines to be administered: <?=$row["FutureDoses"]?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} ?>
</body>
</html>
