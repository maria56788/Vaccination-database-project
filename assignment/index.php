<?php require_once '../database.php';

if (isset($conn)) {
    $statement = $conn->prepare('SELECT p.firstName, p.middleName, p.lastName , publichealthworker.employeeID, h.startShift, h.endShift, publichealthworker.facilityID
    FROM publichealthworker
    INNER JOIN person p on publichealthworker.personID = p.pID
    INNER JOIN history h on publichealthworker.employeeID = h.employeeID AND publichealthworker.facilityID = h.facilityID
    WHERE publichealthworker.exist = 1 
    AND publichealthworker.employeeID = :employeeID
    AND IF(h.endDate IS NULL,IF(:date > h.startDate,1,0),IF(:date BETWEEN h.startDate AND h.endDate,1,0)) = 1;');
    $statement->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <title>Document</title>
</head>
<body>

<table>
    <h1>Schedule of Public HealthWorker</h1>
    <a href="./create.php">Assign a new shift</a>
    <thead>
    <tr>
        <td>First Name</td>
        <td>Middle Name</td>
        <td>Last Name</td>
        <td>employeeID</td>
       <td>jobType</td>
       <td>startShift</td>
       <td>endShift</td>
         <td>FacilityID</td> 
        <td>Actions</td>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
        <tr>
            <td><?= $row["firstName"] ?></td>
            <td><?= $row["middleName"] ?></td>
            <td><?= $row["LastNme"] ?></td>
            <td><?= $row["employeeID"] ?></td>
            <td><?= $row["startShift"] ?></td>
            <td><?= $row["endShift"] ?></td>
             <td><?= $row["FacilityID"] ?></td>
           
            
            <td>
                <a href="./delete.php?employeeID=<?= $row["employeeID"]?>&facilityID=<?= $row["facilityID"]?>">Delete</a>
                <a href="./edit.php?employeeID=<?= $row["employeeID"]?>&facilityID=<?= $row["facilityID"]?>">Edit</a>
            </td>

        </tr>
    <?php } ?>
    </tbody>
</table>
<p>Choose the link to go back to the homepage</p>
<a href="../"> Back to homepage</a>
</body>
</html>