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
        <!-- new user output page, calls new_user from db_function.php -->
    <?php
        include("../header.php");

        $uadd = $_POST['uadd'];
        $padd = $_POST['padd'];

        echo '<div class="addcontent">';
        new_user($uadd, $padd, $conn);
        echo '</div>';
    ?>

</body>
</html>


