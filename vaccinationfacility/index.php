<?php require_once '../database.php';

if (isset($conn)) {
    $statement = $conn->prepare('SELECT * FROM cnc353_2.vaccinationfacility WHERE vaccinationfacility.exist = 1');
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
    <h1>List of Provinces</h1>
    <a href="./create.php">Add a new Province</a>
    <thead>
    <tr>
        <td>Facility ID</td>
        <td>Facility Name</td>
        <td>Facility Type</td>
        <td>Phone</td>
        <td>Web Address</td>
        <td>Capacity</td>
        <td>City</td>
        <td>Province</td>
        <td>Postal Code</td>
        <td>Address</td>
        <td>Only Appointment</td>
        <td>Actions</td>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($statement)) {
        while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["fID"] ?></td>
                <td><?= $row["fName"] ?></td>
                <td><?= $row["fType"] ?></td>
                <td><?= $row["phone"] ?></td>
                <td><?= $row["webAddress"] ?></td>
                <td><?= $row["capacity"] ?></td>
                <td><?= $row["city"] ?></td>
                <td><?= $row["province"] ?></td>
                <td><?= $row["postalCode"] ?></td>
                <td><?= $row["address"] ?></td>
                <td><?= $row["onlyAppoint"] ?></td>

                <td>
                    <a href="./delete.php?fID=<?= $row["fID"] ?>">Delete</a>
                    <a href="./edit.php?fID=<?= $row["fID"] ?>">Edit</a>
                </td>

            </tr>
        <?php }
    } ?>
    </tbody>
</table>
<p>Choose the link to go back to the homepage</p>
<a href="../"> Back to homepage</a>
</body>
</html>