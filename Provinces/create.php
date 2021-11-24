<?php require_once '../database.php';

if(isset($_POST['province'])
    &&isset($_POST['AgeGroupID'])){
        
    $provinces = $conn->prepare("INSERT INTO cnc353_2.provinces (province, AgeGroupID, ageMin)
    VALUES (:province, :AgeGroupID, :ageMin;");

    $provinces->bindParam(":province",$_POST["province"]);
    
    $provinces->bindParam(":AgeGroupID",$_POST["AgeGroupID"]);
      
    $provinces->execute();

    if($provinces->execute())
        header("Location: .");
    

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a provinces</title>
</head>
<body>
    <form action="./create.php" method="post">
        <label for="province"></label>province<br>
        <input type="text" name="province" id="province"><br>
        
        <label for="AgeGroupID"></label>AgeGroupID<br>
        <input type="number" name="AgeGroupID" id="AgeGroupID"><br>
        
    </form>
</body>
</html>