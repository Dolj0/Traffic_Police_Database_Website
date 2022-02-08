<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href = "../resources/css/stylesheet.css?v=1.5">
    <script type="text/javascript" src="../resources/javascript/logic.js?v=1.1"></script>
    
    <?php
        session_start();
        include("../config/config.php");
        
    ?>

</head>
    <body>

    <?php
        include("header.php");
    ?>

    <br>
    
    <!-- the general structure of this core webpage was inspired by a combination of w3 school's collapsible
    and the answers given by cristi_b on the below stack overflow answer
    https://stackoverflow.com/questions/14071250/how-to-place-two-forms-on-the-same-page
    https://www.w3schools.com/howto/howto_js_collapsible.asp -->
    <!-- each button of type collapsible forms a key function of the website -->
   
    <button type="button" class="collapsible" onclick="collapse(0)">People Look-up</button>
    <div class="content">
        <p>Enter Name or Driving Licence Number</p>
        <form  action= "lookup/people_look_up.php" method="post">
            <input type="text" id="psearch" name="psearch" placeholder="John">
            <button name="case" value="1" type="submit">Search</button>
        </form> 
    <br>
    </div>


    <button type="button" class="collapsible" onclick="collapse(1)">Vehicle Look-up</button>
    <div class="content">
    <p>Enter Name or Driving Licence Number</p>
    <form action= "lookup/vehicle_look_up.php" method="post">
        <input type="text" id="vsearch" name="vsearch" placeholder="LB15AJL">
        <button name="case" value="2" type="submit">Search</button>
    </form>  
    <br>
    </div>


    <button type="button" class="collapsible" onclick="collapse(2)">Incident Look-up and Edit</button>
    <div class="content">
    <p>Enter Name, Licence Plate or Date (YYYY-MM-DD)</p>
    <form action="lookup/incident_look_up.php" method="post">
        <input type="text" id="isearch" name="isearch" placeholder="2018-07-23">
        <button name="case" value="3" type="submit">Search</button>
    </form>  
    <br>
    </div>

    <br>
    <br>
    <br>

    <button type="button" class="collapsible" onclick="collapse(3)">Enter New Person</button>
    <div class="content">
    <form action="new/new_person.php" method="post">
        <label for="PersonName">Name:</label>
        <input type="text" id="PersonName" name="PersonName" placeholder="John Doe">
        <br>
        <label for="PersonLicenceNumber">Driving Licence Number:</label>
        <input type="text" id="PersonLicenceNumber" name="PersonLicenceNumber" placeholder="DOEJO12KLOFJJ111">
        <br>
        <label for="PersonAddress">Address:</label>
        <input type="text" id="PersonAddress" name="PersonAddress" placeholder="1 Blogg Way, Nottingham">
        <br>
        <button name="case" value="4" type="submit">Submit</button>
    </form>  
    <br>
    </div>

    <!-- the insert part of the website contains drop down menus containing data from the database -->

    <button type="button" class="collapsible" onclick="collapse(4)">Enter New Vehicle</button>
    <div class="content">
    <form action="new/new_vehicle.php" method="post" autocomplete="off">
        
        <label for="VehicleMake">Vehicle Make:</label>
        <input type="text" id="VehicleMake" name="VehicleMake" placeholder="SKODA">
        <br>
        <label for="VehicleModel">Vehicle Model:</label>
        <input type="text" id="VehicleModel" name="VehicleModel" placeholder="Fabia">
        <br>
        <label for="VehicleColour">Vehicle Colour:</label>
        <input type="text" id="VehicleColour" name="VehicleColour" placeholder="Red">
        <br>
        <label for="VehiclePlate">Vehicle Licence Plate:</label>
        <input type="text" id="VehiclePlate" name="VehiclePlate" placeholder="EX12 PLE">
        <br>
        <label for="VehicleOwnerID">Owner Name:</label>
        <select id="VehicleOwnerID" name="VehicleOwnerID">
            <option value="NotInDB">Person Not In Database</option> 
            <?php
                $sql = "SELECT People_ID, People_Name, People_address FROM People";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    echo '<option value="'.$row["People_ID"].'">'.$row["People_Name"].", ".$row["People_address"].'</option>';
                }
            ?>
        </select>
        <br>
        <br>
        <button type="button" class="collapsible" onclick="collapse(5)">Person Not In DB?</button>
        <div class="content">
            <p>Please Leave Empty if Driver is already in the Database</p>
            <label for="PersonName">Name:</label>
            <input type="text" id="PersonName" name="PersonName" value="">
            <br>
            <label for="PersonLicenceNumber">Driving Licence Number:</label>
            <input type="text" id="PersonLicenceNumber" name="PersonLicenceNumber" value="">
            <br>
            <label for="PersonAddress">Address:</label>
            <input type="text" id="PersonAddress" name="PersonAddress"  value="">
            <br>
        </div>
        <br>
        <br>
        <button name="case" value="5" type="submit">Submit</button>
    </form>  
    <br>
    </div>

    
    <button type="button" class="collapsible" onclick="collapse(6)">Enter Incident Report</button>
    <div class="content">
    <form action= "new/new_incident.php" method="post" autocomplete="off">
        <label for="ReportPID">Name:</label>
        <select id="ReportPID" name="ReportPID">
        <option value="Person Not In Database">Person Not In Database</option> 
            <?php
                $sql = "SELECT People_ID, People_Name, People_address FROM People";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    echo '<option value="'.$row["People_ID"].'">'.$row["People_Name"].", ".$row["People_address"].'</option>';
                }
            ?>
        </select>
        <br>
        <label for="ReportLicenceNumber">Vehicle Licence Number:</label>
        <select id="ReportLicenceNumber" name="ReportLicenceNumber">
            <option value="Vehicle Not In Database">Vehicle Not In Database</option> 
            <?php
                $sql = "SELECT Vehicle_licence FROM Vehicle";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    echo '<option value="'.$row["Vehicle_licence"].'">'.$row["Vehicle_licence"].'</option>';
                }
            ?>
        </select>
        <br>
        <label for="ReportDate">Date of Incident:</label>
        <input type="text" id="ReportDate" name="ReportDate" placeholder="2020-12-01">
        <br>
        <label for="ReportOffence">Offence:</label>
        <select id="ReportOffence" name="ReportOffence">
            <?php
                $sql = "SELECT Offence_description FROM Offence";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    echo '<option value="'.$row["Offence_description"].'">'.$row["Offence_description"].'</option>';
                }
            ?>
        </select>
        <br>
        <label for="ReportDescription">Incident Description:</label>
        <br>
        <textarea name="ReportDescription" rows="10" cols="30" placeholder="Vehicle ran a red light, no injuries"></textarea>
        <br>
        <button type="button" class="collapsible" onclick="collapse(7)">Vehicle Not In Database?</button>
        <div class="content">
            <p>Please Leave Empty if Vehicle is already in the Database</p>
            <label for="VehicleMake">Vehicle Make:</label>
            <input type="text" id="VehicleMake" name="VehicleMake" value="">
            <br>
            <label for="VehicleModel">Vehicle Model:</label>
            <input type="text" id="VehicleModel" name="VehicleModel" value="">
            <br>
            <label for="VehicleColour">Vehicle Colour:</label>
            <input type="text" id="VehicleColour" name="VehicleColour" value="">
            <br>
            <label for="VehiclePlate">Vehicle Licence Plate:</label>
            <input type="text" id="VehiclePlate" name="VehiclePlate" value="">
            <br>
            <label for="VehicleOwnerName">Owner Name:</label>
            <select id="VehicleOwnerName" name="VehicleOwnerName">
                <option value="Person Not In Database">Person Not In Database</option> 
                <?php
                    $sql = "SELECT People_Name FROM People";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo '<option value="'.$row["People_Name"].'">'.$row["People_Name"].'</option>';
                    }
                ?>
            </select>
        </div>
        <br>
        <br>
        <button type="button" class="collapsible" onclick="collapse(8)">Person Not In Database?</button>
        <div class="content">
            <p>Please Leave Empty if Driver is already in the Database</p>
            <label for="PersonName">Name:</label>
            <input type="text" id="PersonName" name="PersonName" value="">
            <br>
            <label for="PersonLicenceNumber">Driving Licence Number:</label>
            <input type="text" id="PersonLicenceNumber" name="PersonLicenceNumber" value="">
            <br>
            <label for="PersonAddress">Address:</label>
            <input type="text" id="PersonAddress" name="PersonAddress"  value="">
            <br>
        </div>
        <br>
        <br>
        <button name="case" value="6" type="submit">Submit</button>
    </form>
    </div>
    
<?php

    // if the session has admin privilages, display admin utils
        
    if($_SESSION['priv'] == "Admin")
    {
        echo "<br>";
        echo "<br>";
        echo "<br>";
        
        echo '<button type="button" class="admincollapsible" onclick="admincollapse(0)">Enter New User</button>';
        echo '<div class="admincontent">';
        echo    '<form action="new/new_user.php" method="post">'; 
        echo        '<label for="uadd">Enter User Name:</label>';
        echo        '<input type="text" id="uadd" name="uadd" placeholder="John">';
        echo        '<br>';
        echo        '<label for="padd">Enter Password Name:</label>';
        echo        '<input type="password" id="padd" name="padd" placeholder="*****">';
        echo        '<br>';
        echo        '<button name="case" value="7" type="submit">Submit</button>';
        echo    '</form>';
        echo '<br>';
        echo '</div>';

        // the drop down menu contains only incidents that do not yet have a fine,
        // artificially enforcing the one to one rule between incident and fine

        echo '<button type="button" class="admincollapsible" onclick="admincollapse(1)">Add Fine to Incident</button>';
        echo '<div class="admincontent">';
        echo    '<form action="new/new_fine.php" method="post">'; 
        echo '<p> If Incident is not on the list, please enter it using the above "Enter Incident Report" button.';
        echo '<br>';
        echo '<br>';
        echo '<label for="IncidentChoice">Incident:</label>';
        echo '<select id="IncidentChoice" name="IncidentChoice">';
                $sql = "SELECT concat(Incident_Date,', ',People_name,', ',Incident_Report) as Incident_list FROM Incident 
                        INNER JOIN People ON Incident.People_ID = People.People_ID
                        LEFT JOIN Fines on Incident.Incident_ID = Fines.Incident_ID
                        WHERE Fines.Fine_ID IS NULL;";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    echo '<option value="'.$row["Incident_list"].'">'.$row["Incident_list"].'</option>';
                }  
        echo '</select>';
        echo '<br>';

        echo        '<label for="fineadd">Enter Fine Amount (GBP):</label>';
        echo        '<input type="number" id="fineadd" name="fineadd" placeholder="2000">';
        echo        '<br>';
        echo        '<label for="pointadd">Enter Awarded Points:</label>';
        echo        '<input type="number" id="pointadd" name="pointadd" placeholder="6">';
        echo        '<br>';
        echo        '<button name="case" value="8" type="submit">Submit</button>';
        echo    '</form>';
        echo '<br>';
        echo '</div>';
        
        }

?>
    <br>
    <br>
    <br>
    <button type="button" class="collapsible" onclick="collapse(9)">Password Change</button>
    <div class="content">
        <form  action= "password_change.php" method="post">
            <label for="oldpass">Old Password:</label>
            <input type="password" id="oldpass" name="oldpass" placeholder="*****">
            <br>
            <label for="newpass">New Password:</label>
            <input type="password" id="newpass" name="newpass" placeholder="*****">
            <br>
            <label for="renewpass">Re-Enter New Password:</label>
            <input type="password" id="renewpass" name="renewpass" placeholder="*****">
            <br>
            <button name="case" value="9" type="submit">Submit</button>
        </form> 
    <br>
    </div>

    </body>
</html>