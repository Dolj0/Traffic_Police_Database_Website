<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "../../resources/css/stylesheet.css?v=1.4">
        <?php
            session_start();
            include("../../config/config.php");
            include("../db_function.php");
        ?>

    </head>
    <body>

    <!-- New incident output page, calls new person, new vehicle and new incident from db_function.php -->

    <?php
        include("../header.php");

        $ReportPID = $_POST['ReportPID'];
        $ReportLicenceNumber = $_POST['ReportLicenceNumber'];
        $ReportDate = $_POST['ReportDate']; 
        $ReportDescription = $_POST['ReportDescription'] ;
        $ReportOffence = $_POST['ReportOffence'];
        $VehicleOwnerName = $_POST['VehichleOwnerName'];
        $VehicleMake = $_POST['VehicleMake'];
        $VehicleModel = $_POST['VehicleModel']; 
        $VehicleColour = $_POST['VehicleColour'] ;
        $VehiclePlate = $_POST['VehiclePlate'];
        $PersonName = $_POST['PersonName'];
        $PersonLicenceNumber = $_POST['PersonLicenceNumber'];
        $PersonAddress = $_POST['PersonAddress'];
        
        echo '<div class="addcontent">';
        if(!empty($PersonName))
        {
            $person_success = new_person($PersonName, $PersonLicenceNumber, $PersonAddress, $conn);
            if($person_success)
            {
                if(!empty($VehicleMake))
                {
                    $vehicle_success = new_vehicle($PersonName, $VehicleMake, $VehicleModel, $VehicleColour, $VehiclePlate, $conn);
                    if($vehicle_success)
                    {
                        new_incident($PersonName, $VehiclePlate, $ReportDate, $ReportDescription, $ReportOffence, $conn);
                    }
                } else {
                    new_incident($ReportPID, $VehicleLicenceNumber, $ReportDate, $ReportDescription, $ReportOffence, $conn);
                }
            } else {
                new_incident($ReportPID, $ReportLicenceNumber, $ReportDate, $ReportDescription, $ReportOffence, $conn);
            }
        } else {
            new_incident($ReportPID, $ReportLicenceNumber, $ReportDate, $ReportDescription, $ReportOffence, $conn);
        }
        echo '</div>';
        
    ?>

</body>
</html>