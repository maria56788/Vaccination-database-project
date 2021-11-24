<?php require_once '../database.php';

if(isset($_POST['gID'])
    &&isset($_POST['ageMax'])
    &&isset($_POST['ageMin'])){
        
    $groupage = $conn->prepare("INSERT INTO cnc353_2.groupage (gID, ageMax, ageMin)
    VALUES (:gID, :ageMax, :ageMin;");

    $groupage->bindParam(":gID",$_POST["gID"]);
    
    $groupage->bindParam(":ageMax",$_POST["ageMax"]);
    
    $groupage->bindParam(":ageMin",$_POST["ageMin"]);
    
    $groupage->execute();

    if($groupage->execute())
        header("Location: .");
    

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a groupage</title>
</head>
<body>
    <form action="./create.php" method="post">
        <label for="gID"></label>gID<br>
        <input type="number" name="gID" id="gID"><br>
        
        <label for="ageMax"></label>ageMax<br>
        <input type="number" name="ageMax" id="ageMax"><br>

        <label for="ageMin"></label>ageMin<br>
        <input type="number" name="ageMin" id="ageMin"><br>
        
    </form>
</body>
</html>