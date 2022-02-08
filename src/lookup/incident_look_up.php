<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "../../resources/css/stylesheet.css?v=1.8">
        <?php
            session_start();
            include("../../config/config.php");
            include("../db_function.php");
        ?>

    </head>
    <body>
        <!-- incident look up output page, calls incident_search from db_function.php -->
    <?php
        include("../header.php");

        $isearch = $_POST['isearch'];

        echo '<div class="addcontent">';
        incident_search($isearch, $conn);
        echo '</div>';
       
    ?>

</body>
</html>