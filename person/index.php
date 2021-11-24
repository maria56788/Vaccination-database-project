<?php require_once '../database.php';

if (isset($conn)) {
    $statement = $conn->prepare('SELECT * FROM cnc353_2.person AS person');
    $statement->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<table>
    <h1>List of person</h1>
    <a href="./create.php">Add a new person</a>
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

            <td>
                <a href="./delete.php?employeeID=<?= $row["employeeID"] ?>,?facilityID=<?= $row["facilityID"] ?>">Delete</a>
                <a href="./edit.php?employeeID=<?= $row["employeeID"] ?>,?facilityID=<?= $row["facilityID"] ?>">Edit</a>
            </td>

        </tr>
    <?php } ?>
    </tbody>
</table>
<p>Choose the link to go back to the homepage</p>
<a href="../"> Back to homepage</a>
</body>
</html>