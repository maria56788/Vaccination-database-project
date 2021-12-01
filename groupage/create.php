<?php require_once '../database.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a group age</title>
</head>
<body>
    <form action="./create-query.php" method="post">
        <label for="gID"></label>gID<br>
        <input type="number" name="gID" id="gID"><br>
        
        <label for="ageMax"></label>ageMax<br>
        <input type="number" name="ageMax" id="ageMax"><br>

        <label for="ageMin"></label>ageMin<br>
        <input type="number" name="ageMin" id="ageMin"><br>

        <button>Submit</button>
    </form>
</body>
</html>