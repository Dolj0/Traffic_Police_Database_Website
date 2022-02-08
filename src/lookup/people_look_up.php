<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "../../resources/css/stylesheet.css?v=1.7">
        <?php
            session_start();
            include('../../config/config.php');
            include('../db_function.php');
           
        ?>

    </head>
    <body>
        <!-- people look up output page, calls people_search from db_function.php -->
    <?php
        include('../header.php');

        $psearch = $_POST['psearch'];
        echo '<div class="addcontent">';
        person_search($psearch, $conn);
        echo '</div>';
        
        
    ?>

</body>
</html>