<?php
    $servername = "127.0.0.1:3307";
    $username = "root";
    $password = "";
    $dbname = "dbname";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (mysqli_connect_errno())
        {
            echo "Failed to connect to 
                MySQL: ".mysqli_connect_error();
        }
   

 //<!-- https://www.tutorialspoint.com/php/php_mysql_login.htm -->
 ?>