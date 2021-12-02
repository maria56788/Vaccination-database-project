<?php
require_once '../database.php';
try {
    $statement = $conn->prepare("UPDATE p.firstName, p.middleName, p.lastName , publichealthworker.employeeID, h.startShift, h.endShift, publichealthworker.facilityID
    FROM publichealthworker
    INNER JOIN person p on publichealthworker.personID = p.pID
    INNER JOIN history h on publichealthworker.employeeID = h.employeeID AND publichealthworker.facilityID = h.facilityID
    WHERE publichealthworker.exist = 1
        
    
                                     SET  
                                     employeeID = :employeeID,
                                     facilityID =:facilityID,  
                                     h.startShift =: h.startShift, 
                                     h.endShift =:h.endShift
                                    WHERE publichealthworker.exist = 1");

    $statement->bindParam(":  WHERE publichealthworker.exist",$_POST["  WHERE publichealthworker.exist"]);

    $statement->bindParam(":employeeID",$_POST["employeeID"]);

    $statement->bindParam(":facilityID",$_POST["facilityID"]);

    $statement->bindParam(":h.startShift",$_POST["h.startShift"]);

    $statement->bindParam(":h.endShift",$_POST["h.endShift"]);

   

    $statement->execute();

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: edit.php?vaccineType={$_POST["vaccineType"]}");
}