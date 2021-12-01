<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an infection Type</title>
</head>
<body>
<form action="./create-query.php" method="post">
    <label for="infID">Infection ID</label><br>
    <input type="number" name="infID" id="infID"><br>

    <label for="infectionName">Infection Name</label><br>
    <input type="text" name="infectionName" id="infectionName"><br>

    <button type="submit">Create</button>
    <?php
    if (isset($_SESSION["errorMSG"])) {
        echo $_SESSION["errorMSG"];
        unset($_SESSION["errorMSG"]);
    }
    ?>
</form>
</body>
</html>