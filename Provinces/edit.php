<?php require_once '../database.php';

$statement = $conn->prepare("SELECT*cnc353_2.provinces AS provinces 
WHERE provinces.province = :province);

$statement->bindParam(":province",$_GET["province"]);

$statement->execute();

$provinces = $statement->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['province'])
        &&isset($_POST['AgeGroupID'])){
        $statement = $conn->prepare("UPDATE cnc353_2.provinces
                                     SET province =:province, 
                                         AgeGroupID = :AgeGroupID,");

    $statement->bindParam(":province",$_POST["province"]);
    
    $statement->bindParam(":AgeGroupID",$_POST["AgeGroupID"]);
        
    $statement->execute();

    if($statement->execute())
        header("Location: .");
    
/*
in the example he gave, used book id to keep track of which book is updated.
problem is that for provinces the key is made of ageMin and province.

throughout the code he uses that book id. Should we use provinces ID?
*/
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit provinces</title>
</head>
<body>
    <form action="./edit.php" method="post">
        <label for="province"></label>province<br>
        <input type="number" name="province" id="province" value="<?= $provinces["province"]?>"><br>
        
        <label for="AgeGroupID"></label>AgeGroupID<br>
        <input type="number" name="AgeGroupID" id="AgeGroupID"value="<?= $provinces["AgeGroupID"]?>"><br>

        <button type="submit">Update</button>
       
    </form>
</body>
</html>


