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
        <!-- new person output page, calls new_person from db_function.php -->
    <?php
        include("../header.php");

        $PersonName = $_POST['PersonName'];
        $PersonLicenceNumber = $_POST['PersonLicenceNumber'];
        $PersonAddress = $_POST['PersonAddress'];
        
        echo '<div class="addcontent">';
        new_person($PersonName, $PersonLicenceNumber, $PersonAddress, $conn);
        echo '</div>';
    ?>

</body>
</html>