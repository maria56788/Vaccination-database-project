<?php require_once '../database.php';

if (isset($conn)) {
    $statement = $conn->prepare('SELECT * FROM cnc353_2.publichealthworker ');
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
    <h1>List of publichealthworker</h1>
    <a href="./create.php">Add a new health worker</a>
    <thead>
        <tr>
            <td>facilityID</td>
            <td>personID</td>
            <td>employeeID</td>
            <td>hourlyRate</td>
            <td>jobType</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    <?php while ($row =$statement->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){?>
            <tr>
                <td><?= $row["facilityID"]?></td>
                <td><?= $row["personID"]?></td>
                <td><?= $row["employeeID"]?></td>
                <td><?= $row["hourlyRate"]?></td>
                <td><?= $row["jobType"]?></td>
                <td>
                    <a href="./delete.php?employeeID=<?= $row["employeeID"]?>,?facilityID=<?= $row["facilityID"]?>">Delete</a>
                    <a href="./edit.php?employeeID=<?= $row["employeeID"]?>,?facilityID=<?= $row["facilityID"]?>">Edit</a>
                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>
<p>Choose the link to go back to the homepage</p>
    <a href="../"> Back to homepage</a>
</body>
</html>