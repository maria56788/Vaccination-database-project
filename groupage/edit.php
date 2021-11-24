<?php require_once '../database.php';

$statement = $conn->prepare("SELECT*cnc353_2.groupage AS groupage 
WHERE groupage.gID = :gID);

$statement->bindParam(":gID",$_GET["gID"]);

$statement->execute();

$groupage = $statement->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['gID'])
        &&isset($_POST['ageMax'])
        &&isset($_POST['ageMin'])){
        $statement = $conn->prepare("UPDATE cnc353_2.groupage
                                     SET gID =:gID, 
                                         ageMax = :ageMax, 
                                         ageMin =:ageMin, ");

    $statement->bindParam(":gID",$_POST["gID"]);
    
    $statement->bindParam(":ageMax",$_POST["ageMax"]);
    
    $statement->bindParam(":ageMin",$_POST["ageMin"]);
    
    $statement->execute();

    if($statement->execute())
        header("Location: .");
    
/*
in the example he gave, used book id to keep track of which book is updated.
problem is that for groupage the key is made of ageMin and gID.

throughout the code he uses that book id. Should we use groupage ID?
*/
}
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
    <form action="./edit.php" method="post">
        <label for="gID"></label>gID<br>
        <input type="number" name="gID" id="gID" value="<?= $groupage["gID"]?>"><br>
        
        <label for="ageMax"></label>ageMax<br>
        <input type="number" name="ageMax" id="ageMax"value="<?= $groupage["ageMax"]?>"><br>

        <label for="ageMin"></label>ageMin<br>
        <input type="number" name="ageMin" id="ageMin"value="<?= $groupage["ageMin"]?>"><br>

        <button type="submit">Update</button>
       
    </form>
</body>
</html>


