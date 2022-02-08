<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "../../resources/css/stylesheet.css?v=1.7">
        <?php
            session_start();
            include("../../config/config.php");
            include("../db_function.php");
        ?>

    </head>
    <body>
        <!-- this page outputs a form prefilled with the user's chosen incident
            posts updates to edit_function.php -->
    <?php
        include("../header.php");

        echo '<div class="addcontent">';

        $edit_ID = $_POST['edit_ID'];

        $isFinedsql = "SELECT * FROM Fines WHERE Incident_ID = '$edit_ID'";
        $finePostedResult = mysqli_query($conn, $isFinedsql);

        if (mysqli_num_rows($finePostedResult)){
            echo "A fine has already been issued for this Incident and therefore it cannot be changed, Please contact your system administrator";
        } else {

            $form_fill_sql = "SELECT Incident.Incident_ID, Incident.Incident_Date,
                Incident.Incident_Report, People.People_ID, People.People_name, 
                People.People_address, Vehicle.Vehicle_licence, 
                Offence.Offence_description from Incident
                INNER JOIN People ON Incident.People_ID = People.People_ID
                INNER JOIN Vehicle ON Incident.Vehicle_ID = Vehicle.Vehicle_ID
                INNER JOIN Offence ON Incident.Offence_ID = Offence.Offence_ID
                WHERE Incident.Incident_ID = '$edit_ID'"; 

            $form_fill_result = mysqli_query($conn, $form_fill_sql);

            $row = mysqli_fetch_assoc($form_fill_result);

            $People_ID = $row["People_ID"];
            $People_address = $row["People_address"];
            $Incident_ID = $row["Incident_ID"]; 
            $Incident_Date = $row["Incident_Date"];
            $Incident_Report = $row['Incident_Report'];
            $People_name = $row['People_name'];
            $Vehicle_licence = $row['Vehicle_licence'];
            $Offence = $row['Offence_description'];


        echo '<p>Below is the selected incident, Edit what is required and leave the rest.</p>';
        echo '<form action= "edit_function.php" method="post" autocomplete="off">
                <label for="ReportName">Name:</label>
                <select id="ReportName" name="ReportName">
                <option value="'.$People_ID.'">'.$People_name.", ".$People_address.'</option>';
                $sql = "SELECT People_ID, People_Name, People_address FROM People";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    echo '<option value="'.$row["People_ID"].'">'.$row["People_Name"].", ".$row["People_address"].'</option>';
                }
        echo '</select>
                <br>
                <label for="ReportLicenceNumber">Vehicle Licence Number:</label>
                <select id="ReportLicenceNumber" name="ReportLicenceNumber">
                <option value='.$Vehicle_licence.'>'.$Vehicle_licence.'</option>';
                    $sql = "SELECT Vehicle_licence FROM Vehicle";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo '<option value="'.$row["Vehicle_licence"].'">'.$row["Vehicle_licence"].'</option>';
                    }
        echo '</select>
                <br>
                <label for="ReportDate">Date of Incident:</label>
                <input type="text" id="ReportDate" name="ReportDate" placeholder='.$Incident_Date.' value='.$Incident_Date.'>
                <br>
                <label for="ReportOffence">Offence:</label>
                <select id="ReportOffence" name="ReportOffence">
                <option value='.$Offence.'>'.$Offence.'</option>';
                    $sql = "SELECT Offence_description FROM Offence";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo '<option value="'.$row["Offence_description"].'">'.$row["Offence_description"].'</option>';
                    }
        echo '</select>
                <br>
                <label for="ReportDescription">Incident Description:</label>
                <br>
                <textarea name="ReportDescription" rows="10" cols="30" placeholder="'.$Incident_Report.'"></textarea>
                <br>';
        echo '<input type="hidden" id="Incident_ID" name="Incident_ID" value='.$edit_ID.'>';
        echo '<button name="submitbutton" value="editbutton" type="submit">Submit Edit</button>';
        echo '<button name="submitbutton" value="deletebutton" type="submit">Delete</button>
            </form>';
    }
    echo '</div>';

    
    ?>

</body>
</html>


