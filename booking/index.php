<?php require_once '../database.php';

if (isset($conn)) {
    $statement = $conn->prepare('SELECT * FROM cnc353_2.booking AS booking WHERE exist = 1');
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
    <title>List of Bookings</title>
</head>
<body>

<table>
    <h1>List of Bookings</h1>
    <a href="./create.php">Add a new Booking</a>
    <thead>
    <tr>
        <td>facilityID</td>
        <td>personID</td>
        <td>timeID</td>
        <td>dayBooked</td>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
        <tr>
            <td><?= $row["facilityID"] ?></td>
            <td><?= $row["personID"] ?></td>
            <td><?= $row["timeID"] ?></td>
            <td><?= $row["dayBooked"] ?></td>
            <td>
                <a href="./delete.php?facilityID=<?= $row["facilityID"] ?>&personID=<?= $row["personID"]?>&dayBooked=<?= $row["dayBooked"]?>">Delete</a>
                <a href="./edit.php?facilityID=<?= $row["facilityID"] ?>&personID=<?= $row["personID"] ?>&dayBooked=<?= $row["dayBooked"]?>">Edit</a>
            </td>

        </tr>
    <?php } ?>
    </tbody>
</table>
<p>Choose the link to go back to the homepage</p>
<a href="../"> Back to homepage</a>
</body>
</html>