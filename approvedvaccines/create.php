<?php require_once '../database.php';

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
    <form action="./create-query.php" method="post">
        <label for="vaccineType"></label>vaccineType<br>
        <input type="text" name="vaccineType" id="vaccineType"><br>
        
        <label for="dateOfApproval"></label>dateOfApproval<br>
        <input type="date" name="dateOfApproval" id="dateOfApproval"><br>

        <label for="vDesc"></label>vDesc<br>
        <input type="text" name="vDesc" id="vDesc"><br>
        
        <label for="vStatus"></label>vStatus<br>
        <input type="text" name="vStatus" id="vStatus"><br>

        <label for="suspendedDate"></label>suspendedDate<br>
        <input type="date" name="suspendedDate" id="suspendedDate"><br>
        
       <button>Submit</button>
    </form>
</body>
</html>