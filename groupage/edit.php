<?php require_once '../database.php';
if (!isset($_GET["gID"])){
    header("Location: index.php");
}
$statement = $conn->prepare("SELECT * FROM cnc353_2.groupage AS groupage 
WHERE groupage.gID = :gID");

$statement->bindParam(":gID",$_GET["gID"]);

$statement->execute();

$groupAge = $statement->fetch(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit groupage</title>
</head>
<body>
    <form action="./edit-query.php" method="post">
        <label for="gID"></label>gID<br>
        <input type="number" name="gID" id="gID" value="<?= $groupAge["gID"]?>"><br>
        
        <label for="ageMax"></label>ageMax<br>
        <input type="number" name="ageMax" id="ageMax" value="<?= $groupAge["ageMax"]?>"><br>

        <label for="ageMin"></label>ageMin<br>
        <input type="number" name="ageMin" id="ageMin" value="<?= $groupAge["ageMin"]?>"><br>

        <button type="submit">Update</button>
       
    </form>
</body>
</html>


