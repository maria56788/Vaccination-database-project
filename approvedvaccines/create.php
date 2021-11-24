<?php require_once '../database.php';

if(isset($_POST['vaccineType'])
    &&isset($_POST['dateOfApproval'])
    &&isset($_POST['vDesc'])
    &&isset($_POST['vStatus'])
    &&isset($_POST['suspendedDate'])){
        
    $approvedvaccines = $conn->prepare("INSERT INTO cnc353_2.approvedvaccines (vaccineType, dateOfApproval, vDesc, vStatus, suspendedDate)
    VALUES (:vaccineType, :dateOfApproval, :vDesc, :vStatus, :suspendedDate;");

    $approvedvaccines->bindParam(":vaccineType",$_POST["vaccineType"]);
    
    $approvedvaccines->bindParam(":dateOfApproval",$_POST["dateOfApproval"]);
    
    $approvedvaccines->bindParam(":vDesc",$_POST["vDesc"]);
    
    $approvedvaccines->bindParam(":vStatus",$_POST["vStatus"]);
    
    $approvedvaccines->bindParam(":suspendedDate",$_POST["suspendedDate"]);

    $approvedvaccines->execute();

    if($approvedvaccines->execute())
        header("Location: .");
    

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a approvedvaccines</title>
</head>
<body>
    <form action="./create.php" method="post">
        <label for="vaccineType"></label>vaccineType<br>
        <input type="text" name="vaccineType" id="vaccineType"><br>
        
        <label for="dateOfApproval"></label>dateOfApproval<br>
        <input type="number" name="dateOfApproval" id="dateOfApproval"><br>

        <label for="vDesc"></label>vDesc<br>
        <input type="text" name="vDesc" id="vDesc"><br>
        
        <label for="vStatus"></label>vStatus<br>
        <input type="text" name="vStatus" id="vStatus"><br>

        <label for="suspendedDate"></label>suspendedDate<br>
        <input type="text" name="suspendedDate" id="suspendedDate"><br>
        
       
    </form>
</body>
</html>