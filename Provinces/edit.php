<?php require_once '../database.php';
if (!isset($_GET["province"])){
    header("Location: index.php");
}

$statement = $conn->prepare("SELECT * FROM province WHERE province = :province");

$statement->bindParam(":province", $_GET["province"]);

$statement->execute();

$province = $statement->fetch(PDO::FETCH_ASSOC);

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
    <label for="province"></label>province<br>
    <input type="text" name="province" id="province" value="<?= $province["province"] ?>" readonly><br>

    <label for="ageGroupID"></label>AgeGroupID<br>
    <input type="number" name="ageGroupID" id="ageGroupID" value="<?= $province["ageGroupID"] ?>"><br>

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


