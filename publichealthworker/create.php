<?php require_once '../database.php';

if(isset($_POST['facilityID'])
    &&isset($_POST['personID'])
    &&isset($_POST['employeeID'])
    &&isset($_POST['hourlyrate'])
    &&isset($_POST['jobType'])){
        
    $publichealthworker = $conn->prepare("INSERT INTO cnc353_2.publichealthworker (facilityID, personID, employeeID, hourlyrate, jobType)
    VALUES (:facilityID, :personID, :employeeID, :hourlyrate, :jobType;");

    $publichealthworker->bindParam(":facilityID",$_POST["facilityID"]);
    
    $publichealthworker->bindParam(":personID",$_POST["personID"]);
    
    $publichealthworker->bindParam(":employeeID",$_POST["employeeID"]);
    
    $publichealthworker->bindParam(":hourlyrate",$_POST["hourlyrate"]);
    
    $publichealthworker->bindParam(":jobType",$_POST["jobType"]);

    $publichealthworker->execute();

    if($publichealthworker->execute())
        header("Location: .");
    

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a publichealthworker</title>
</head>
<body>
    <form action="./create.php" method="post">
        <label for="facilityID"></label>facilityID<br>
        <input type="number" name="facilityID" id="facilityID"><br>
        
        <label for="personID"></label>personID<br>
        <input type="number" name="personID" id="personID"><br>

        <label for="employeeID"></label>employeeID<br>
        <input type="number" name="employeeID" id="employeeID"><br>
        
        <label for="hourlyrate"></label>hourlyrate<br>
        <input type="number" name="hourlyrate" id="hourlyrate"><br>

        <label for="jobType"></label>jobType<br>
        <input type="text" name="jobType" id="jobType"><br>
        
       
    </form>
</body>
</html>