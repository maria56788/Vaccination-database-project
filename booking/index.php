<?php require_once '../database.php';

if (isset($conn)) {
    $statement = $conn->prepare('SELECT * FROM cnc353_2.timeslot AS Booking ');
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
    <h1>Available Time slots</h1>
    <a href="./book.php">Book a slot</a>
    <thead>
    <tr>
        <td>Time Slot ID</td>
        <td>Start Time</td>
        <td>End Time</td>
        <td>Day</td>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($statement)) {
        while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["tID"] ?></td>
                <td><?= $row["startTime"] ?></td>
                <td><?= $row["endTime"] ?></td>
                <td><?= $row["day"] ?></td>
                

            </tr>
        <?php }
    } ?>
    </tbody>
</table>
<p>Choose the link to go back to the homepage</p>
<a href="../"> Back to homepage</a>
</body>
</html>