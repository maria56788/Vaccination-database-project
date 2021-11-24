<?php require_once '../database.php';

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
        
    $person = $conn->prepare("INSERT INTO cnc353_2.person (pID, firstName, middleName, lastName, phone, citizenship, postalCode, email, city, address, DoB, province, groupAgeID)
    VALUES (:pID, :firstName, :middleName, :lastName, :phone, :citizenship, :postalCode, :email, :city, :address, :DoB, :province, :groupAgeID;");

    $person->bindParam(":pID",$_POST["pID"]);
    
    $person->bindParam(":firstName",$_POST["firstName"]);
    
    $person->bindParam(":middleName",$_POST["middleName"]);
    
    $person->bindParam(":lastName",$_POST["lastName"]);
    
    $person->bindParam(":phone",$_POST["phone"]);

    $person->bindParam(":citizenship",$_POST["citizenship"]);

    $person->bindParam(":postalCode",$_POST["postalCode"]);

    $person->bindParam(":email",$_POST["email"]);

    $person->bindParam(":city",$_POST["city"]);

    $person->bindParam(":address",$_POST["address"]);

    $person->bindParam(":DoB",$_POST["DoB"]);

    $person->bindParam(":province",$_POST["province"]);

    $person->bindParam(":groupAgeID",$_POST["groupAgeID"]);

    $person->execute();

    if($person->execute())
        header("Location: .");
    

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Person</title>
</head>
<body>
<form action="./create.php" method="post">
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
        <input type="text" name="citizenship" id="citizenship"value="<?= $person["citizenship"]?>"><br>

        <label for="postalCode"></label>postalCode<br>
        <input type="text" name="postalCode" id="postalCode"value="<?= $person["postalCode"]?>"><br>

        <label for="email"></label>email<br>
        <input type="text" name="email" id="email"value="<?= $person["email"]?>"><br>

        <label for="city"></label>city<br>
        <input type="text" name="city" id="city"value="<?= $person["city"]?>"><br>

        <label for="address"></label>address<br>
        <input type="text" name="address" id="address"value="<?= $person["address"]?>"><br>

        <label for="DoB"></label>DoB<br>
        <input type="number" name="DoB" id="DoB"value="<?= $person["DoB"]?>"><br>

        <label for="province"></label>province<br>
        <input type="text" name="province" id="province"value="<?= $person["province"]?>"><br>

        <label for="groupAgeID"></label>groupAgeID<br>
        <input type="number" name="groupAgeID" id="groupAgeID"value="<?= $person["groupAgeID"]?>"><br>

        <button type="submit">Update</button>
       
    </form>
</body>
</html>