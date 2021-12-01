<?php require_once '../database.php';

if (isset($conn)) {
    $statement = $conn->prepare('SELECT * FROM approvedvaccines AS approvedvaccines WHERE exist = 1');
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
    <h1>List of Approved Vaccines</h1>
    <a href="./create.php">Add a new Approved Vaccine</a>
    <thead>
    <tr>
        <td>vaccineType</td>
        <td>dateOfApproval</td>
        <td>vDesc</td>
        <td>vStatus</td>
        <td>suspendedDate</td>
        <td>Actions</td>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
        <tr>
            <td><?= $row["vaccineType"] ?></td>
            <td><?= $row["dateOfApproval"] ?></td>
            <td><?= $row["vDesc"] ?></td>
            <td><?= $row["vStatus"] ?></td>
            <td><?= $row["suspendedDate"] ?></td>
            <td>
                <a href="./delete.php?vaccineType=<?= $row["vaccineType"]?>">Delete</a>
                <a href="./edit.php?vaccineType=<?= $row["vaccineType"] ?>">Edit</a>
            </td>

        </tr>
    <?php } ?>
    </tbody>
</table>
<p>Choose the link to go back to the homepage</p>
<a href="../"> Back to homepage</a>
</body>
</html>