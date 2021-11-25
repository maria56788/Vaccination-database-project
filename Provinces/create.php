<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a provinces</title>
</head>
<body>
<form action="./create-query.php" method="post">
    <label for="province"></label>province<br>
    <input type="text" name="province" id="province"><br>

    <label for="ageGroupID"></label>AgeGroupID<br>
    <input type="number" name="ageGroupID" id="ageGroupID"><br>

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