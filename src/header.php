
<!-- Header is included in all pages bar the login, and generates the banner seen throughout the website -->
<?php
    echo '<div class="banner">';
    echo 'Police Traffic Database';
    echo '<br>';
    echo '<div class= "banner" style="font-size: 90%; padding-top: 1px; padding-bottom: 1px;">';
    echo $_SESSION['priv'].": ".$_SESSION['user'];
    echo '<form action="https://localhost/traffic_police_database/src/home_page.php" method="post" style="text-align: center; display:inline-block; float:left; padding-left:10px">';
    echo '<button name="home" type="submit">Home</button>';
    echo '</form>';
    echo '<div style="width:5px; height:auto; display:inline-block;"></div>';
    echo '<form action="https://localhost/traffic_police_database/index.php" method="post" style="text-align: center; display:inline-block; float:right; padding-right:10px">';
    echo '<button name="logout" type="submit" value="logout">Logout</button>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
    echo '<br>';
?>