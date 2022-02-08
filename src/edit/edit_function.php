<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "../../resources/css/stylesheet.css?v=1.6">
        <?php
            session_start();
            include("../../config/config.php");
            include("../db_function.php");
        ?>

    </head>
    <body>
        <!-- edit output page, calls incident_delete and new_incident from db_function.php -->
    <?php
        include("../header.php");

        $ReportName = $_POST['ReportName'];
        $ReportLicenceNumber = $_POST['ReportLicenceNumber'];
        $ReportDate = $_POST['ReportDate'];
        $ReportOffence = $_POST['ReportOffence'];
        $ReportDescription = $_POST['ReportDescription'];
        $Incident_ID = $_POST['Incident_ID'];
        
        $submitbutton = $_POST['submitbutton'];

        if($submitbutton == 'deletebutton'){
            echo '<div class="addcontent">';
            incident_delete($Incident_ID, $conn);
            echo '</div>';
        } else {
            echo '<div class="addcontent">';
            incident_delete($Incident_ID, $conn);
            new_incident($ReportName, $ReportLicenceNumber, $ReportDate,  $ReportDescription, $ReportOffence, $conn);
            echo '</div>';
        }
       
    ?>

</body>
</html>
