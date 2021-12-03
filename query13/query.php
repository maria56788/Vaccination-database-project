<?php
require_once "../database.php";
try {


    $nurses = $conn->prepare("SELECT publichealthworker.employeeID, person.firstName,person.lastName,person.email, publichealthworker.hourlyRate, h2.startDate, h2.endDate, publichealthworker.facilityID
FROM publichealthworker
         INNER JOIN person on publichealthworker.personID=person.pID
         INNER JOIN history h2 on publichealthworker.employeeID = h2.employeeID and publichealthworker.facilityID = h2.facilityID
where publichealthworker.employeeID NOT IN
      (SELECT publichealthworker.employeeID
       FROM publichealthworker
                INNER JOIN person p on publichealthworker.personID = p.pID
                INNER JOIN history h on publichealthworker.employeeID = h.employeeID AND publichealthworker.facilityID = h.facilityID
       WHERE publichealthworker.exist = 1
         AND IF(h.endDate IS NULL,IF(:date > h.startDate,1,0),IF(:date BETWEEN h.startDate AND h.endDate,1,0)) = 1
         AND publichealthworker.facilityID = :facilityID
         AND publichealthworker.jobType = 'nurse')
  AND publichealthworker.jobType = 'nurse'
  AND publichealthworker.facilityID = :facilityID
");
    $nurses->bindParam(":facilityID", $_POST["facilityID"]);
    $nurses->bindParam(":date", $_POST["date"]);
    $nurses->execute();


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
<table>
    <h1>Nurses </h1>

    <thead>
    <tr>
        <td>firstName</td>
        <td>lastName</td>
        <td>email</td>
        <td>hourlyRate</td>

        <td>startDate</td>
        <td>endDate</td>

        <td>facilityID</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($nurses as $row) { ?>
        <tr>
            <td><?= $row["firstName"] ?></td>
            <td><?= $row["lastName"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["hourlyRate"] ?></td>

            <td><?= $row["startDate"] ?></td>
            <td><?= $row["endDate"] ?></td>

            <td><?= $row["facilityID"] ?></td>


        </tr>
    <?php } ?>
    </tbody>
</table>
<p>Choose the link to go back to the homepage</p>
<a href="../"> Back to homepage</a>
</body>
</html>