
<!-- This page contains all major website functionality and most of the SQL queries -->

<?php

    // the output tables for the first three functions are based on the w3 schools table website
    // https://www.w3schools.com/html/html_tables.asp

    function person_search($psearch, $conn) {
        $sql = "SELECT * FROM People WHERE UPPER(People_Name) 
        LIKE UPPER('%$psearch%') 
        OR UPPER(People_Licence) LIKE UPPER('%$psearch%')";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if (mysqli_query($conn, $sql)) {
          
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }


        if($count == 0)
        {
            echo "  Name or Licence Not found in database";
        } else
        {
            echo "<table>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Licence</th>
                    </tr>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>
                        <td>".$row["People_name"]."</td>
                        <td>".$row["People_address"]."</td>
                        <td>".$row["People_licence"]."</td>";
            }
            echo "</table>";

        }
            
    }

    function vehicle_search($vsearch, $conn) {

        $sql = "SELECT Vehicle.Vehicle_licence, Vehicle.Vehicle_type, 
        Vehicle.Vehicle_colour, People.People_Name, People.People_licence
        FROM Ownership
        INNER JOIN People ON Ownership.People_ID = People.People_ID
        INNER JOIN Vehicle ON Ownership.Vehicle_ID = Vehicle.Vehicle_ID
        WHERE Vehicle.Vehicle_licence = '$vsearch'
        OR UPPER(People.People_Name) LIKE UPPER('%$vsearch%')";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        if($count == 0)
        {
            echo "  Vehicle Licence Not found in database";
        } else
        {
            echo "<table>
                    <tr>
                        <th>Licence</th>
                        <th>Type</th>
                        <th>Colour</th>
                        <th>Owner Name</th>
                        <th>Owner Licence</th>
                    </tr>";
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>
                        <td>".$row["Vehicle_licence"]."</td>
                        <td>".$row["Vehicle_type"]."</td>
                        <td>".$row["Vehicle_colour"]."</td>
                        <td>".$row["People_Name"]."</td>
                        <td>".$row["People_licence"]."</td>";
            }
            echo "</table>";
        }
    }

    function incident_search($isearch, $conn){
        $sql = "SELECT Incident.Incident_ID, Incident.Incident_Date,
            Incident.Incident_Report, People.People_name, 
            Vehicle.Vehicle_licence, Offence.Offence_description from Incident
            INNER JOIN People ON Incident.People_ID = People.People_ID
            INNER JOIN Vehicle ON Incident.Vehicle_ID = Vehicle.Vehicle_ID
            INNER JOIN Offence ON Incident.Offence_ID = Offence.Offence_ID
            WHERE Vehicle.Vehicle_licence LIKE '$isearch' 
            OR UPPER(People.People_name) LIKE UPPER('%$isearch%')
            OR  Incident.Incident_Date LIKE '$isearch'";

            $result = mysqli_query($conn, $sql);

            //the below includes the creation of a new form for each row of the output table,
            //Clicking the created button posts the user to incident_edit.php
            if(!$result)
            {
                echo "  No Incident Found for '".$isearch."' search query";
            } else
            {
                echo "<table>
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Licence</th>
                    <th>Type</th>
                    <th>Report</th>
                    <th>Edit?</th>
                </tr>";

            while($row = mysqli_fetch_assoc($result))
            {
            echo "<tr>
                    <td>".$row["Incident_Date"]."</td>
                    <td>".$row["People_name"]."</td>
                    <td>".$row["Vehicle_licence"]."</td>
                    <td>".$row["Offence_description"]."</td>
                    <td>".$row["Incident_Report"]."</td>
                    <td>
                        <form action='../edit/incident_edit.php' method='post'>
                            <button name='edit_ID' value='".$row["Incident_ID"]."' type='submit'>Edit</button>
                        </form>
                    </td>";
            }
            echo "</table>";
            }
    }

    function new_person($PersonName, $PersonLicenceNumber, $PersonAddress, $conn){
       
        $sqlPersonCreate = "INSERT INTO People (People_name, People_address, People_licence) 
                            VALUES ('$PersonName', '$PersonAddress', '$PersonLicenceNumber')";

        if (mysqli_query($conn, $sqlPersonCreate)) {
            echo "  New Person created successfully";
            return TRUE;
            } else {
            echo "  Error: " . $sqlPersonCreate . "<br>" . mysqli_error($conn);
            return FALSE;
            }
    }

    function new_vehicle($VehicleOwnerID, $VehicleMake, $VehicleModel, $VehicleColour, $VehiclePlate, $conn){
        
            $VehicleModelConcat = $VehicleMake." ".$VehicleModel;
            //Create The Vehicle
            $sqlVehicleCreate = "INSERT INTO Vehicle (Vehicle_type, Vehicle_colour, Vehicle_licence) 
                                VALUES ('$VehicleModelConcat', '$VehicleColour', '$VehiclePlate')";
            if (mysqli_query($conn, $sqlVehicleCreate)) {
                echo "  New Vehicle created successfully";
            } else {
                echo "  Error: " . $sqlVehicleCreate . "<br>" . mysqli_error($conn);
            }
            //Get ID numbers for Vehicle
            $sqlVehicleID = "SELECT Vehicle_ID FROM Vehicle WHERE Vehicle_licence LIKE ('$VehiclePlate')";
            $VehicleIDObject = mysqli_query($conn, $sqlVehicleID);
            $VehicleID = $VehicleIDObject -> fetch_row()[0];


            //update ownership 'relationship' table
            $sqlOwnershipCreate = "INSERT INTO Ownership (People_ID, Vehicle_ID)
                                     VALUES ($VehicleOwnerID, $VehicleID)";
            if (mysqli_query($conn, $sqlOwnershipCreate)) {
                #echo "New Ownership realtion created successfully";
                return TRUE;
            } else {
                echo "  Error: " . $sqlOwnershipCreate . "<br>" . mysqli_error($conn);
                return FALSE;
            }
    }

    function new_incident($ReportPID, $ReportLicenceNumber, $ReportDate, $ReportDescription, $ReportOffence, $conn){

        //Vehicle Queery is odd, mysqli_num_rows won't work, neither will fetch_row
        $sqlVehicleCheck = "SELECT Vehicle_ID FROM Vehicle WHERE Vehicle_licence='$ReportLicenceNumber'";
        $sqlVehicleCheckResult = mysqli_query($conn, $sqlVehicleCheck);
        $vehicleCount = 0;
        while($row = mysqli_fetch_assoc($sqlVehicleCheckResult))
        {
            $vehicleCount = ++$vehicleCount;
            $VehicleID = $row['Vehicle_ID'];
        }
        
        if($vehicleCount == 0)
        {
            echo "  There is no vehicle in the database with that licence. \n
                  Please return to the user page and correct the licence input or enter a new vehicle using Enter New Vehicle";
        
        }

        //Check if car and driver match, if not suggest car may be stolen
        $sqlStolenCheck = "SELECT Vehicle_ID FROM Ownership WHERE People_ID = '$ReportPID'";
        $sqlStolenCheckResult = mysqli_query($conn, $sqlStolenCheck);
        $StolenCheckVehicleID = $sqlStolenCheckResult -> fetch_row()[0];

        if(!($StolenCheckVehicleID==$VehicleID)){
            echo "<div style='color: red;'>BEWARE: Car may be stolen or uninsured. Vehicle owner does not match person in report</div>";
        }
        

        //Get the Offence
        $sqlOffenceID = "SELECT Offence_ID FROM Offence WHERE Offence_description LIKE ('$ReportOffence')";
        $sqlOffenceIDResult = mysqli_query($conn, $sqlOffenceID);

        $OffenceID = $sqlOffenceIDResult -> fetch_row()[0];
        $PeopleID = $ReportPID;

        //Create the incident
        $sqlIncidentCreate = "INSERT INTO Incident (Vehicle_ID, People_ID, Incident_date, Incident_Report, Offence_ID)
                                 VALUES ('$VehicleID', '$PeopleID', '$ReportDate', '$ReportDescription', '$OffenceID')";

        if (mysqli_query($conn, $sqlIncidentCreate)) {
            echo "  New Incident created successfully";
        } else {
            echo "  Error: " . $sqlIncidentCreate . "<br>" . mysqli_error($conn);
            
        }    
    }

    function new_user($uadd, $padd, $conn){
        $sql = "INSERT INTO Users (User_Name, User_Password, User_Permissions)
        VALUES ('$uadd', '$padd', 'User')";

        if (mysqli_query($conn, $sql)) {
            echo "  New User created successfully";
        } else {
            echo "  Error: " . $sqlIncidentCreate . "<br>" . mysqli_error($conn);
        }

    }

    function new_fine($IncidentChoice, $fineadd, $pointadd, $conn){
        $sqlGetIncidentID = "SELECT Incident_ID, Offence_maxFine, Offence_maxPoints FROM Incident 
        INNER JOIN People ON Incident.People_ID = People.People_ID
        INNER JOIN Offence ON Incident.Offence_ID = Offence.Offence_ID
        WHERE concat(Incident_Date,', ',People_name,', ',Incident_Report) = '$IncidentChoice'";

        $IncidentIDResult = mysqli_query($conn, $sqlGetIncidentID);

        // Process all rows, php doesn't like sigular row returns
        while($row = mysqli_fetch_array($IncidentIDResult)) {
           $IncidentID = $row['Incident_ID'];      
           $Offence_maxFine = $row['Offence_maxFine'];
           $Offence_maxPoints = $row['Offence_maxPoints'];
        }

        // If both points and fines are equal or below their maximum, insert new fine to table
        if (($fineadd <= $Offence_maxFine) and ($pointadd <= $Offence_maxPoints)){
            $sql = "INSERT INTO Fines (Fine_Amount, Fine_Points, Incident_ID)
                VALUES ('$fineadd','$pointadd', '$IncidentID')";
            
            if (mysqli_query($conn, $sql)) {
                echo "  Fine awarded successfully";
            } else {
                echo "  Error: " . $sql . "<br>" . mysqli_error($conn);
            
            }
        } else {
            echo "Fine not awarded as given fine or points are greater than the available maximum<br>";
            echo "Given Fine: ".$fineadd.", Max Fine: ".$Offence_maxFine."<br>";
            echo "Given Points: ".$pointadd.", Max Points: ".$Offence_maxPoints."<br>";
        }
     
       
    }

    function incident_delete($Incident_ID, $conn){
        $sqlIncident_delete = "DELETE FROM Incident WHERE Incident_ID LIKE ".$Incident_ID;

        if (mysqli_query($conn, $sqlIncident_delete)) {
            echo "  Incident Succesffully deleted";
        } else {
            echo "  Error: " . $sqlIncident_delete . "<br>" . mysqli_error($conn);
        }
    }

    function password_change($oldpass, $newpass, $renewpass, $username, $conn){
        $sqlOldCheck = "SELECT User_ID, User_Password FROM Users WHERE User_Name = '$username'";
        $sqlOldCheckResult = mysqli_query($conn, $sqlOldCheck);

        while($row = mysqli_fetch_assoc($sqlOldCheckResult)){
            $currentPassword = $row['User_Password'];
            $user_ID = $row['User_ID'];
        }
        
        //checks that password is correct, aswell as that the two new passwords match
        if(trim($currentPassword) != trim($oldpass)){
            echo "The old password does not match your current password, please try again.";
        } else {
            if ($newpass!=$renewpass){
                echo "You Entered one of your new passwords wrong, please try again.";
            } else {
                $sqlUpdatePassword = "UPDATE Users SET User_Password = '$newpass' WHERE User_ID = '$user_ID'";
                if (mysqli_query($conn, $sqlUpdatePassword)) {
                    echo "Password Succesffully Updated";
                } else {
                    echo "  Error: " . $sqlUpdatePassword . "<br>" . mysqli_error($conn);
                }
            } 
        }
    }

?>