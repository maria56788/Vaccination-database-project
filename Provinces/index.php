<?php require_once '../database.php';

if (isset($conn)) {
    $statement = $conn->prepare('SELECT * FROM cnc353_2.province ');
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
        <td>province</td>
        <td>AgeGroupID</td>
        <td>Actions</td>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($statement)) {
        while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["province"] ?></td>
                <td><?= $row["ageGroupID"] ?></td>
                <td>
                    <a href="./delete.php?province=<?= $row["province"] ?>">Delete</a>
                    <a href="./edit.php?province=<?= $row["province"] ?>">Edit</a>
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