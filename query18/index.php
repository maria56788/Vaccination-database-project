<?php
require_once "../database.php";

try {
$statement = $conn->query("SELECT person.firstName ,person.middleName, person.lastName, person.phone, totalTable.totalGiven
FROM
(SELECT p.personID idNurse, COUNT(vic.vaccinationID) AS totalGiven, p.exist p_exist, vic.exist vic_exist
FROM publichealthworker p
INNER JOIN vaccination_inside_country vic on p.employeeID = vic.nurseID
GROUP BY idNurse
HAVING totalGiven > 1
) AS totalTable
INNER JOIN person ON person.pID = idNurse
WHERE totalTable.p_exist = 1
AND totalTable.vic_exist = 1 
AND person.exist = 1 
ORDER BY totalGiven DESC");

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
    <title>Overperforming Nurses</title>
</head>
<body>
<?php if (isset($statement)) {
    foreach ($statement as $row) { ?>
    <div class="row">
        <div class="col s12 ">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title"><?=$row["firstName"].' '.$row["middleName"].' '.$row["lastName"]?></span>
                    <p>Telephone: <?=$row["phone"]?></p>
                    <p>Vaccines administered: <?=$row["totalGiven"]?></p>
                </div>
            </div>
        </div>
    </div>
    <?php }
} ?>
</body>
</html>
