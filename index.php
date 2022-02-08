<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href = "resources/css/stylesheet.css?version=2.3">
    <script type="text/javascript" src="resources/javascript/logic.js"></script>
    <title>Document</title>
</head>
<div class="bg">
<body>

    <div class="logincontent">
        <h>Traffic Police Database</h>
    </div>

    <!-- Login collapsible -->
    <div class="login">
    <button type="button" class="collapsible" onclick="collapse(0)">Login</button>
    <div class="content">
    <form method = "post">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username">
        <br>
        <label for="username">Password: </label>
        <input type="password" id="password" name="password">
        <br>
        <input type="submit" value="Login">
    </form>
    </div>
    </div>

    <?php
    error_reporting(0);

    // Cease Session if logged out function
    if($_POST['logout'] == 'logout'){
        mysqli_close($conn);
        session_abort();
    }

    include("config/config.php");
    session_start();

    // Instead of posting to home_page.php, posted variables are used to create $_SESSION variables
    // Ensuring the correct user permissions persist throughout the session
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $givenusername = $_POST['username'];
        $givenpassword = $_POST['password'];
        $sql = "SELECT * FROM Users WHERE User_Name ='$givenusername' AND User_Password='$givenpassword'";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
        $perm = $row["User_Permissions"];
        $name = $row["User_Name"];

        if($count == 0)
        {
            echo "There was an error loggining in";
        } else
        {
            $_SESSION['user'] = $name;
            $_SESSION['priv'] = $perm;
            header("location: src/home_page.php");
        }

    }
    ?>

</body>
</div>
</html>