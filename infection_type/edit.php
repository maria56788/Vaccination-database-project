<?php require_once '../database.php';
if (!isset($_GET["infID"])){
    header("Location: index.php");
}

$statement = $conn->prepare("SELECT * FROM cnc353_2.infection_type WHERE infID = :infID");

$statement->bindParam(":infID", $_GET["infID"]);

$statement->execute();

$infectionType = $statement->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Edit provinces</title>
</head>
<body>
<form action="./edit-query.php" method="post">
    <label for="infID"></label>Infection ID<br>
    <input type="number" name="infID" id="infID" value="<?= $infectionType["infID"] ?>" readonly><br>

    <label for="infectionName"></label>Infection Name<br>
    <input type="text" name="infectionName" id="infectionName" value="<?= $infectionType["infectionName"] ?>"><br>

    <button type="submit">Update</button>

</form>
<?php
if (isset($_SESSION["errorMSG"])) {
    echo $_SESSION["errorMSG"];
    unset($_SESSION["errorMSG"]);
}
?>
</body>
</html>


