<?php
require_once '../database.php';
try {

    $persons = $conn->prepare('SELECT pID From cnc353_2.person
        WHERE firstName = :firstName AND middleName = :middleName AND lastName = :lastName AND person.exist = 1');
    $persons->bindParam(":firstName", $_POST["firstName"]);
    if (!empty($_POST[":middleName"])) {
        $persons->bindParam(":middleName", $_POST["middleName"]);
    }else{
        $null = "NULL";
        $persons->bindParam(":middleName", $null);
    }
    $persons->bindParam(":middleName", $_POST["middleName"]);
    $persons->bindParam(":lastName", $_POST["lastName"]);
    $persons->execute();

    if ($persons->rowCount() != 1){
        throw new PDOException();
        echo "nothing 1";
    }
    else{
        echo "something";
    }
    $person = $persons->fetch();
    $pID = $person["pID"];




    $totalCapacity = $conn->prepare(" SELECT vaccinationfacility.capacity
    FROM vaccinationfacility
    WHERE vaccinationfacility.fID =:facilityID");

    $totalCapacity->bindParam(':facilityID',$POST['facilityID']);
    $totalCapacity->execute();
    if ($totalCapacity->rowCount() != 1){
        throw new PDOException();
        echo "nothing 2";
    }
    $tc = $totalCapacity->fetch();
    $nurse_per_time = $tc["vaccinationfacility.capacity"];





    $bookings_at_time = $conn->prepare(" SELECT COUNT(booking.timeID) AS appointments
    FROM booking , vaccinationfacility
    WHERE booking.timeID = :timeID
    AND booking.dayBooked = :dayBooked
    AND vaccinationfacility.fID = :facilityID");

    $bookings_at_time->bindParam(':timeID',$POST['timeID']);
    $bookings_at_time->bindParam(':dayBooked',$POST['dayBooked']);
    $bookings_at_time->bindParam(':facilityID',$POST['facilityID']);

    $bookings_at_time->execute();

    if ($bookings_at_time->rowCount() != 1){
        throw new PDOException();
        echo "nothing 3";
    }

    $bat = $bookings_at_time->fetch();

    $frequency = $bat["appointments"];



    $province_eligibility =$conn->prepare(" SELECT province.ageGroupID
    FROM province , vaccinationfacility
    WHERE :facilityID  = vaccinationfacility.fID
    AND province.province = vaccinationfacility.province");

    $province_eligibility->bindParam(':facilityID',$POST['facilityID']);

    $province_eligibility->execute();

    if ($province_eligibility->rowCount() != 1){
        throw new PDOException();
        echo "nothing 4";
    }

    $prov_e = $province_eligibility->fetch();

    $province_age = $prov_e["province.ageGroupID"];




    $person_eligibility =$conn->prepare("SELECT person.groupAgeID
    FROM person
    WHERE person.firstName = :firstName AND person.lastName = :lastName AND person.middleName = :middleName");
    $person_eligibility->bindParam(':firstName',$POST['firstName']);
    $person_eligibility->bindParam(':lastName',$POST['lastName']);

    $person_eligibility->execute();

    if ($person_eligibility->rowCount() != 1){
        throw new PDOException();
        echo "nothing 5";
    }
    $per_e = $person_eligibility->fetch();

    $person_age = $per_e["person.groupAgeID"];

    



    $person_with_mcn =$conn->prepare("SELECT MedicalCardNumber 
    FROM person_with_mcn , person
    WHERE person_with_mcn.personID = :personID");
    
    $person_with_mcn->bindParam(":personID", $pID);

    $person_with_mcn->execute();

    if ($person_with_mcn->rowCount() != 1){
        throw new PDOException();
        echo "nothing 6";
    }
    $pwm = $person_with_mcn->fetch();

    $has_mcn=$pwm["MedicalCardNumber"];



    $person_with_passport = $conn->prepare("SELECT passportNumber 
    FROM person_with_passport , person
    WHERE person_with_passport.personID = :personID");

    $person_with_passport->bindParam(":personID", $pID);

    $person_with_passport->execute();

    if ($person_with_passport->rowCount() != 1){
        throw new PDOException();
        echo "nothing 7";
    }

    $pwp = $person_with_passport->fetch();

    $has_pass = $person_with_passport["passportNumber"];



    $person_with_booking = $conn->prepare("SELECT booking.personID
                                            FROM booking
                                            WHERE booking.personID = :person limit 1");
    $person_with_booking->bindParam(":personID", $pID);

    $person_with_booking->execute();

    if ($person_with_booking->rowCount() != 1){
        throw new PDOException();
        echo "nothing 8";
    }
    $pwb = $person_with_booking->fetch();

    $has_booking = $pwb["booking.personID"];




    $facility_type = $conn->prepare("SELECT vaccinationfacility.onlyAppoint
    FROM vaccinationfacility
    WHERE vaccinationfacility.fID = :facilityID");
    $facility_type->bindParam(":facilityID", $_POST["facilityID"]);

    $facility_type->execute();

    if ($facility_type->rowCount() != 1){
        throw new PDOException();
        echo "nothing 9";
    }
    $ft = $facility_type->fetch();

    $booking_only =$ft["vaccinationfacility.onlyAppoint"];



    $Phw_person = $conn->prepare("SELECT publichealthworker.personID  FROM publichealthworker
    WHERE publichealthworker.personID = :personID");

    $Phw_person->bindParam(":person", $pID);

    $Phw_person->execute();
    if ($Phw_person->rowCount() != 1){
        throw new PDOException();
        echo "nothing 10";
    }

    $health_w =  $Phw_person->fetch();

    $isPHW= $health_w["publichealthworker.personID"];



    $maximum = $conn->prepare("SELECT COUNT(*) AS total FROM timeslot");

    $maximum->execute();
    if ($maximum->rowCount() != 1){
        throw new PDOException();
        echo "nothing 11";
    }
    $max = $maximum->fetch();

    $maxBooked = $nurse_per_time * $max["total"];



    $total_on_date = $conn->prepare("SELECT COUNT(booking.timeID) AS tid
    FROM booking , vaccinationfacility
    WHERE booking.dayBooked = :dayBooked
    AND vaccinationfacility.fID = :facilityID");
    $total_on_date->bindParam(':dayBooked',$POST['dayBooked']);
    $total_on_date->bindParam(':facilityID',$POST['facilityID']);

    $total_on_date->execute();
    if ($total_on_date->rowCount() != 1){
        throw new PDOException();
        echo "nothing 12";
    }
    
    $tod = $total_on_date->fetch();

    $total_bookings = $tod["tid"];

    if(is_null($has_booking)){
        echo" booking nul";
    }
    else{
        echo"didnt work";
    }



    if($booking_only =1){
        if(is_null($has_booking) or 
            is_null($has_pass) or 
            is_null($has_mcn) or
            $frequency = $nurse_per_time or
            $frequency >$nurse_per_time )
            {
                echo" Vaccination Not allowed";
            }

        else{
                if(is_null($isPHW)){
                    if($person_age > $province_age){
                        echo "vaccination not allowed. Too young for province eligibility.";
                    }
                    else{
                        $vaccination = $conn->prepare("INSERT INTO vaccination(vID, pID, doseNumber, lotNumberOfDose, date, vType, exist)
                        VALUES(:VID, :pID, :doseNumber , :lotNumberOfDose, :dayBooked, :vType , 1)");

                        $vaccination->bindParam(":vID",$_POST["vID"]);

                        $vaccination->bindParam(":pID",$pID);

                        $vaccination->bindParam(":doseNumber",$_POST["doseNumber"]);

                        $vaccination->bindParam(":lotNumberOfDose",$_POST["lotNumberOfDose"]);

                        $vaccination->bindParam(":dayBooked",$_POST["dayBooked"]);

                        $vaccination->bindParam(":vType",$_POST["vType"]);

                        $vaccination->execute();

                        $vac_inside = $conn->prepare("INSERT INTO vaccination_inside_country(vaccinationID, nurseID, facilityID, exist)
                        VALUES(:VID, :nurseID, :facilityID ,1)");

                        $vac_inside->bindParam(":vID",$_POST["vID"]);

                        $vac_inside->bindParam(":nurseID",$_POST["nurseID"]);

                        $vac_inside->bindParam(":facilityID",$_POST["facilityID"]);

                        $vac_inside->execute();

                    }
                }
                else{
                    $vaccination = $conn->prepare("INSERT INTO vaccination(vID, pID, doseNumber, lotNumberOfDose, date, vType, exist)
                        VALUES(:VID, :pID, :doseNumber , :lotNumberOfDose, :dayBooked, :vType , 1)");

                        $vaccination->bindParam(":vID",$_POST["vID"]);

                        $vaccination->bindParam(":pID",$pID);

                        $vaccination->bindParam(":doseNumber",$_POST["doseNumber"]);

                        $vaccination->bindParam(":lotNumberOfDose",$_POST["lotNumberOfDose"]);

                        $vaccination->bindParam(":dayBooked",$_POST["dayBooked"]);

                        $vaccination->bindParam(":vType",$_POST["vType"]);

                        $vaccination->execute();

                        $vac_inside = $conn->prepare("INSERT INTO vaccination_inside_country(vaccinationID, nurseID, facilityID, exist)
                        VALUES(:VID, :nurseID, :facilityID ,1)");

                        $vac_inside->bindParam(":vID",$_POST["vID"]);

                        $vac_inside->bindParam(":nurseID",$_POST["nurseID"]);

                        $vac_inside->bindParam(":facilityID",$_POST["facilityID"]);

                        $vac_inside->execute();
                }
            }

    }
    else{
        if(is_null($has_booking) or 
            $total_bookings = $maxBooked or
            is_null($has_pass) or 
            is_null($has_mcn) or
            $frequency = $nurse_per_time or
            $frequency >$nurse_per_time )
            {
                echo" Vaccination Not allowed";
            }
        else{
            if(is_null($isPHW)){
                if($person_age > $province_age){
                    echo "vaccination not allowed. Too young for province eligibility.";
                }
                else{
                    $vaccination = $conn->prepare("INSERT INTO vaccination(vID, pID, doseNumber, lotNumberOfDose, date, vType, exist)
                    VALUES(:VID, :pID, :doseNumber , :lotNumberOfDose, :dayBooked, :vType , 1)");

                    $vaccination->bindParam(":vID",$_POST["vID"]);

                    $vaccination->bindParam(":pID",$pID);

                    $vaccination->bindParam(":doseNumber",$_POST["doseNumber"]);

                    $vaccination->bindParam(":lotNumberOfDose",$_POST["lotNumberOfDose"]);

                    $vaccination->bindParam(":dayBooked",$_POST["dayBooked"]);

                    $vaccination->bindParam(":vType",$_POST["vType"]);

                    $vaccination->execute();

                    $vac_inside = $conn->prepare("INSERT INTO vaccination_inside_country(vaccinationID, nurseID, facilityID, exist)
                    VALUES(:VID, :nurseID, :facilityID ,1)");

                    $vac_inside->bindParam(":vID",$_POST["vID"]);

                    $vac_inside->bindParam(":nurseID",$_POST["nurseID"]);

                    $vac_inside->bindParam(":facilityID",$_POST["facilityID"]);

                    $vac_inside->execute();

                }
            }
            else{
                $vaccination = $conn->prepare("INSERT INTO vaccination(vID, pID, doseNumber, lotNumberOfDose, date, vType, exist)
                    VALUES(:VID, :pID, :doseNumber , :lotNumberOfDose, :dayBooked, :vType , 1)");

                    $vaccination->bindParam(":vID",$_POST["vID"]);

                    $vaccination->bindParam(":pID",$pID);

                    $vaccination->bindParam(":doseNumber",$_POST["doseNumber"]);

                    $vaccination->bindParam(":lotNumberOfDose",$_POST["lotNumberOfDose"]);

                    $vaccination->bindParam(":dayBooked",$_POST["dayBooked"]);

                    $vaccination->bindParam(":vType",$_POST["vType"]);

                    $vaccination->execute();

                    $vac_inside = $conn->prepare("INSERT INTO vaccination_inside_country(vaccinationID, nurseID, facilityID, exist)
                    VALUES(:VID, :nurseID, :facilityID ,1)");

                    $vac_inside->bindParam(":vID",$_POST["vID"]);

                    $vac_inside->bindParam(":nurseID",$_POST["nurseID"]);

                    $vac_inside->bindParam(":facilityID",$_POST["facilityID"]);

                    $vac_inside->execute();
            }
            
        }
    }

    
    

    

    header("Location: index.php ");
} catch (PDOException $e) {
    $_SESSION['errorMSG'] = 'Generic Error Message';
    header("Location: create.php ");
}