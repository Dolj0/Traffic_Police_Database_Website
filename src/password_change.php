<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "../resources/css/stylesheet.css?v=1.4">
        <?php
            session_start();
            include("../config/config.php");
            include("db_function.php");
        ?>

    </head>
    <body>


    <!-- Password change output page, calls password_change from db_function.php -->
    <?php
        include("header.php");

        $oldpass = $_POST['oldpass'];
        $newpass = $_POST['newpass'];
        $renewpass = $_POST['renewpass'];
        $username = $_SESSION['user'];

        echo '<div class="addcontent">';
        password_change($oldpass, $newpass, $renewpass, $username, $conn);
        echo '</div>';
    ?>

</body>
</html>


