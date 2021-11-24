<?php require_once '../database.php';

$statement = $conn->prepare("SELECT*cnc353_2.person AS person 
WHERE person.pID = :pID);

$statement->bindParam(":pID",$_GET["pID"]);

$statement->execute();

$person = $statement->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['pID'])
        &&isset($_POST['firstName'])
        &&isset($_POST['middleName'])
        &&isset($_POST['lastName'])
        &&isset($_POST['phone'])
        &&isset($_POST['citizenship'])
        &&isset($_POST['postalCode'])
        &&isset($_POST['email'])
        &&isset($_POST['city'])
        &&isset($_POST['address'])
        &&isset($_POST['DoB'])
        &&isset($_POST['province'])
        &&isset($_POST['groupAgeID'])){
        $statement = $conn->prepare("UPDATE cnc353_2.person
                                     SET pID =:pID, 
                                         firstName = :firstName, 
                                         middleName =:middleName, 
                                         lastName =:lastName, 
                                         phone =:phone,
                                         citizenship =:citizenship,
                                         postalCode =:postalCode,
                                         email =:email,
                                         city =:city,
                                         address =:address,
                                         DoB =:DoB,
                                         province =:province,
                                         groupAgeID =:groupAgeID" );

    $statement->bindParam(":pID",$_POST["pID"]);
    
    $statement->bindParam(":firstName",$_POST["firstName"]);
    
    $statement->bindParam(":middleName",$_POST["middleName"]);
    
    $statement->bindParam(":lastName",$_POST["lastName"]);
    
    $statement->bindParam(":phone",$_POST["phone"]);

    $statement->bindParam(":citizenship",$_POST["citizenship"]);

    $statement->bindParam(":postalCode",$_POST["postalCode"]);

    $statement->bindParam(":email",$_POST["email"]);

    $statement->bindParam(":city",$_POST["city"]);

    $statement->bindParam(":address",$_POST["address"]);

    $statement->bindParam(":DoB",$_POST["DoB"]);

    $statement->bindParam(":province",$_POST["province"]);

    $statement->bindParam(":groupAgeID",$_POST["groupAgeID"]);

    $statement->execute();

    if($statement->execute())
        header("Location: .");
    
/*
in the example he gave, used book id to keep track of which book is updated.
problem is that for person the key is made of middleName and pID.

throughout the code he uses that book id. Should we use person ID?
*/
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit person</title>
</head>
<body>
    <form action="./edit.php" method="post">
        <label for="pID"></label>pID<br>
        <input type="number" name="pID" id="pID" value="<?= $person["pID"]?>"><br>
        
        <label for="firstName"></label>firstName<br>
        <input type="text" name="firstName" id="firstName"value="<?= $person["firstName"]?>"><br>

        <label for="middleName"></label>middleName<br>
        <input type="text" name="middleName" id="middleName"value="<?= $person["middleName"]?>"><br>
        
        <label for="lastName"></label>lastName<br>
        <input type="text" name="lastName" id="lastName"value="<?= $person["lastName"]?>"><br>

        <label for="phone"></label>phone<br>
        <input type="number" name="phone" id="phone"value="<?= $person["phone"]?>"><br>

        <label for="citizenship"></label>citizenship<br>
        <input type="number" name="citizenship" id="citizenship"value="<?= $person["citizenship"]?>"><br>

        <label for="postalCode"></label>postalCode<br>
        <input type="number" name="postalCode" id="postalCode"value="<?= $person["postalCode"]?>"><br>

        <label for="email"></label>email<br>
        <input type="number" name="email" id="email"value="<?= $person["email"]?>"><br>

        <label for="city"></label>city<br>
        <input type="number" name="city" id="city"value="<?= $person["city"]?>"><br>

        <label for="address"></label>address<br>
        <input type="number" name="address" id="address"value="<?= $person["address"]?>"><br>

        <label for="DoB"></label>DoB<br>
        <input type="number" name="DoB" id="DoB"value="<?= $person["DoB"]?>"><br>

        <label for="province"></label>province<br>
        <input type="number" name="province" id="province"value="<?= $person["province"]?>"><br>

        <label for="groupAgeID"></label>groupAgeID<br>
        <input type="number" name="groupAgeID" id="groupAgeID"value="<?= $person["groupAgeID"]?>"><br>

        <button type="submit">Update</button>
       
    </form>
</body>
</html>
