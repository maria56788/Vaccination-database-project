<?php require_once '../database.php';

$statement = $conn->prepare("SELECT*cnc353_2.approvedvaccines AS approvedvaccines 
WHERE approvedvaccines.vaccineType = :vaccineType AND approvedvaccines.vDesc = :vDesc");

$statement->bindParam(":vDesc",$_GET["vDesc"]);

$statement->bindParam(":vaccineType",$_GET["vaccineType"]);

$statement->execute();

$approvedvaccines = $statement->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['vaccineType'])
        &&isset($_POST['dateOfApproval'])
        &&isset($_POST['vDesc'])
        &&isset($_POST['vStatus'])
        &&isset($_POST['suspendedDate'])){
        $statement = $conn->prepare("UPDATE cnc353_2.approvedvaccines
                                     SET vaccineType =:vaccineType, 
                                         dateOfApproval = :dateOfApproval, 
                                         vDesc =:vDesc, 
                                         vStatus =:vStatus, 
                                         suspendedDate =:suspendedDate");

    $statement->bindParam(":vaccineType",$_POST["vaccineType"]);
    
    $statement->bindParam(":dateOfApproval",$_POST["dateOfApproval"]);
    
    $statement->bindParam(":vDesc",$_POST["vDesc"]);
    
    $statement->bindParam(":vStatus",$_POST["vStatus"]);
    
    $statement->bindParam(":suspendedDate",$_POST["suspendedDate"]);

    $statement->execute();

    if($statement->execute())
        header("Location: .");
    
/*
in the example he gave, used book id to keep track of which book is updated.
problem is that for approvedvaccines the key is made of vDesc and vaccineType.

throughout the code he uses that book id. Should we use approvedvaccines ID?
*/
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit approvedvaccines</title>
</head>
<body>
    <form action="./edit.php" method="post">
        <label for="vaccineType"></label>vaccineType<br>
        <input type="number" name="vaccineType" id="vaccineType" value="<?= $approvedvaccines["vaccineType"]?>"><br>
        
        <label for="dateOfApproval"></label>dateOfApproval<br>
        <input type="number" name="dateOfApproval" id="dateOfApproval"value="<?= $approvedvaccines["dateOfApproval"]?>"><br>

        <label for="vDesc"></label>vDesc<br>
        <input type="number" name="vDesc" id="vDesc"value="<?= $approvedvaccines["vDesc"]?>"><br>
        
        <label for="vStatus"></label>vStatus<br>
        <input type="number" name="vStatus" id="vStatus"value="<?= $approvedvaccines["vStatus"]?>"><br>

        <label for="suspendedDate"></label>suspendedDate<br>
        <input type="text" name="suspendedDate" id="suspendedDate"value="<?= $approvedvaccines["suspendedDate"]?>"><br>

        <button type="submit">Update</button>
       
    </form>
</body>
</html>
