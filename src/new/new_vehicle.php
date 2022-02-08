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
        <!-- New vehicle output page, calls new_person and new_vehicle from db_function.php -->
    <?php
        include("../header.php");


        $VehicleOwnerID = $_POST['VehicleOwnerID'];
        $VehicleMake = $_POST['VehicleMake'];
        $VehicleModel = $_POST['VehicleModel'];
        $VehicleColour = $_POST['VehicleColour'];
        $VehiclePlate = $_POST['VehiclePlate'];
        $PersonName = $_POST['PersonName'];
        
        $PersonLicenceNumber = $_POST['PersonLicenceNumber'];
        $PersonAddress = $_POST['PersonAddress'];

        echo '<div class="addcontent">'; 
        if (!empty($PersonName))
        {
            $success = new_person($PersonName, $PersonLicenceNumber, $PersonAddress, $conn);
            if($success)
            {
                $personIDsql = "SELECT People_ID FROM People WHERE People_name = '$PersonName'";
                $personIDsqlResult = mysqli_query($conn, $personIDsql);
                while($row = mysqli_fetch_assoc($personIDsqlResult))
                {       
                    $VehicleOwnerID = $row['People_ID'];
                }

                new_vehicle($VehicleOwnerID, $VehicleMake, $VehicleModel, $VehicleColour, $VehiclePlate, $conn);
            } 
        } else {
            new_vehicle($VehicleOwnerID, $VehicleMake, $VehicleModel, $VehicleColour, $VehiclePlate, $conn);
        }
        echo '</div>';

        
    ?>

</body>
</html>