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
        <!-- vehicle look up output page, calls vehicle_search from db_function.php -->
    <?php
        include("../header.php");

        $vsearch = $_POST['vsearch'];
        echo '<div class="addcontent">';
        vehicle_search($vsearch, $conn);
        echo '</div>';

    ?>

</body>
</html>