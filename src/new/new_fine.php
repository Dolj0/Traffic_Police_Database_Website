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
        
    <!-- new fine output page, calls new_fine from db_function.php -->
    <?php
        include("../header.php");

        $IncidentChoice = $_POST['IncidentChoice'];
        $fineadd = $_POST['fineadd'];
        $pointadd = $_POST['pointadd'];

        echo '<div class="addcontent">';
        new_fine($IncidentChoice, $fineadd, $pointadd, $conn);
        echo '</div>';
    ?>

</body>
</html>


