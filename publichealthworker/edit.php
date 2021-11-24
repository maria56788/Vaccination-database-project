<?php require_once '../database.php';

$statement = $conn->prepare("SELECT*cnc353_2.publichealthworker AS publichealthworker 
WHERE publichealthworker.facilityID = :facilityID AND publichealthworker.employeeID = :employeeID");

$statement->bindParam(":employeeID",$_GET["employeeID"]);

$statement->bindParam(":facilityID",$_GET["facilityID"]);

$statement->execute();

$publichealthworker = $statement->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['facilityID'])
        &&isset($_POST['personID'])
        &&isset($_POST['employeeID'])
        &&isset($_POST['hourlyrate'])
        &&isset($_POST['jobType'])){
        $statement = $conn->prepare("UPDATE cnc353_2.publichealthworker
                                     SET facilityID =:facilityID, 
                                         personID = :personID, 
                                         employeeID =:employeeID, 
                                         hourlyrate =:hourlyrate, 
                                         jobType =:jobType");

    $statement->bindParam(":facilityID",$_POST["facilityID"]);
    
    $statement->bindParam(":personID",$_POST["personID"]);
    
    $statement->bindParam(":employeeID",$_POST["employeeID"]);
    
    $statement->bindParam(":hourlyrate",$_POST["hourlyrate"]);
    
    $statement->bindParam(":jobType",$_POST["jobType"]);

    $statement->execute();

    if($statement->execute())
        header("Location: .");
    
/*
in the example he gave, used book id to keep track of which book is updated.
problem is that for Publichealthworker the key is made of employeeID and facilityID.

throughout the code he uses that book id. Should we use publichealthworker ID?
*/
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Publichealthworker</title>
</head>
<body>
    <form action="./edit.php" method="post">
        <label for="facilityID"></label>facilityID<br>
        <input type="number" name="facilityID" id="facilityID" value="<?= $publichealthworker["facilityID"]?>"><br>
        
        <label for="personID"></label>personID<br>
        <input type="number" name="personID" id="personID"value="<?= $publichealthworker["personID"]?>"><br>

        <label for="employeeID"></label>employeeID<br>
        <input type="number" name="employeeID" id="employeeID"value="<?= $publichealthworker["employeeID"]?>"><br>
        
        <label for="hourlyrate"></label>hourlyrate<br>
        <input type="number" name="hourlyrate" id="hourlyrate"value="<?= $publichealthworker["hourlyrate"]?>"><br>

        <label for="jobType"></label>jobType<br>
        <input type="text" name="jobType" id="jobType"value="<?= $publichealthworker["jobType"]?>"><br>

        <button type="submit">Update</button>
       
    </form>
</body>
</html>
