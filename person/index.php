<?php require_once '../database.php';

if (isset($conn)) {
    $statement = $conn->query('SELECT pID, firstName, middleName, lastName, phone, citizenship, postalCode, email, city, address, DoB, province, groupAgeID, person_with_mcn.MCExpDate, person_with_mcn.MCIssueDate, person_with_mcn.MedicalCardNumber, person_with_passport.passportNumber  FROM (cnc353_2.person
        Left JOIN cnc353_2.person_with_mcn ON person.pID = person_with_mcn.personID)
        Left JOIN cnc353_2.person_with_passport ON person.pID = person_with_passport.personID
        WHERE person.exist = 1;');
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
    <h1>List of persons</h1>
    <h2>Add a new person <a href="./create.php?mcn=1">with a Medical Card Number</a>/<a href="./create.php?mcn=0">with a Passport Number</a></h2>


    <thead>
    <tr>
        <td>pID</td>
        <td>firstName</td>
        <td>middleName</td>
        <td>lastName</td>
        <td>phone</td>
        <td>citizenship</td>
        <td>postalCode</td>
        <td>email</td>
        <td>city</td>
        <td>address</td>
        <td>DoB</td>
        <td>province</td>
        <td>groupAgeID</td>
        <td>MCEXPDate</td>
        <td>MCIssueDate</td>
        <td>MedicalCardNumber</td>
        <td>passportNumber</td>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
        <tr>
            <td><?= $row["pID"] ?></td>
            <td><?= $row["firstName"] ?></td>
            <td><?= $row["middleName"] ?></td>
            <td><?= $row["lastName"] ?></td>
            <td><?= $row["phone"] ?></td>
            <td><?= $row["citizenship"] ?></td>
            <td><?= $row["postalCode"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["city"] ?></td>
            <td><?= $row["address"] ?></td>
            <td><?= $row["DoB"] ?></td>
            <td><?= $row["province"] ?></td>
            <td><?= $row["groupAgeID"] ?></td>
            <td><?= $row["MCExpDate"] ?></td>
            <td><?= $row["MCIssueDate"] ?></td>
            <td><?= $row["MedicalCardNumber"] ?></td>
            <td><?= $row["passportNumber"] ?></td>

            <td></td>
            <td></td>
            <td>
                <a href="./delete.php?pID=<?= $row["pID"] ?>">Delete</a>
                <a href="./edit.php?pID=<?= $row["pID"] ?>">Edit</a>
            </td>

        </tr>
    <?php } ?>
    </tbody>
</table>
<p>Choose the link to go back to the homepage</p>
<a href="../"> Back to homepage</a>
</body>
</html>