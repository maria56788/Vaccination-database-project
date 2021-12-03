<?php require_once '../database.php';

if (isset($conn)) {
$vac = $conn->query('SELECT * FROM vaccination AS Vaccinations WHERE exist = 1');

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
    <title>List of Vaccinations</title>
</head>
<body>


<table>
    <h1>List of Vaccinations</h1>
    <a href="create.php">Add a Vaccination</a>
    <thead>
        <tr>
            <td>vID</td>
            <td>pID</td>
            <td>doseNumber</td>
            <td>lotNumberOfDose</td>
            <td>date</td>
            <td>vType</td>
            <td>exist</td>
           

        </tr>
    </thead>
    <tbody>
        <?php while ($row =$vac->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT)){?>
            <tr>
                <td><?= $row["vID"]?></td>
                <td><?= $row["pID"]?></td>
                <td><?= $row["doseNumber"]?></td>
                <td><?= $row["lotNumberOfDose"]?></td>
                <td><?= $row["date"]?></td>
                <td><?= $row["vType"]?></td>
                <td><?= $row["exist"]?></td>
                
                
                
            </tr>

    <?php } ?>
    </tbody>
</table>


<p>Choose the link to go back to the homepage</p>
    <a href="../"> Back to homepage</a>
</body>
</html>