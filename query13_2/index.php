<?php require_once '../database.php';

if (isset($conn)) {
    $statement = $conn->prepare('SELECT person.firstName, person.lastName, person.email, publichealthworker.hourlyRate, startDate , endDate , history.facilityID
    FROM history , publichealthworker,person
    WHERE DATE(startDate) NOT IN (select startDate FROM history where DATE(startDate) < "2010-01-01" AND DATE(endDate) >"2010-01-01") 
    AND DATE(endDate) NOT IN (select endDate FROM history where DATE(startDate) < "2010-01-01" AND DATE(endDate) >"2010-01-01") 
    AND history.facilityID=2 AND history.employeeID = publichealthworker.employeeID AND history.facilityID = publichealthworker.facilityID AND publichealthworker.jobType ="nurse"
    AND person.pID = publichealthworker.personID 
    
    ORDER BY hourlyRate ASC;');
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
    <title>Nurses</title>
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
    <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
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