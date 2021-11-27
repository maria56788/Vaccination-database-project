<?php require_once '../database.php';
if (!isset($_GET["pID"])){
    header("Location: index.php");
}
$statement = $conn->prepare("SELECT * FROM cnc353_2.approvedvaccines AS approvedvaccines 
WHERE approvedvaccines.vaccineType = :vaccineType");

$statement->bindParam(":vaccineType",$_GET["vaccineType"]);

$statement->execute();

$approvedvaccines = $statement->fetch(PDO::FETCH_ASSOC);

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
<?php
if (isset($_SESSION["errorMSG"])) {
     echo $_SESSION["errorMSG"];
     unset($_SESSION["errorMSG"]);
}
    ?>
</body>
</html>
