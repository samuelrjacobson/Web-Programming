<?php
    // so home page knows where we're redirecting to it from
    setcookie("origin", "login");
    session_start();
?>
<!DOCTYPE HTML>
<!-- This file creates a web page for login to a shopping site. -->
<html lang="en">
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
            function display_login()
            {
                // Display login page
                print '
                <h1>Login</h1>

                <!-- User enters information and clicks submit to register -->
                <form method="get" action="home.php">
                    <table>
                        <tr><td>User ID:&nbsp;</td><td><input id="userId" name="userId"></input></td></tr>
                        <tr><td>Password:&nbsp;</td><td><input name="pwd"></input></td></tr>
                        
                        <tr><td><input type="submit"></td></tr>
                    </table>
                </form>

                <a href="register.php"><button>Go to Registration Page</button></a>';
            }

            // Determine where user came from
            $size = 0;
            foreach ($_GET as $key=>$value)
            {
                $size++;
            }
            if(isset($_COOKIE["origin-is-home"]) && $_COOKIE["origin-is-home"] == "true"){    // User logged out
                // Log out
                unset($_SESSION["useId"]); 
                unset($_SESSION["pwd"]);
                unset($_SESSION["name"]);
                unset($_SESSION["ccn"]);
                unset($_SESSION["address"]);
                session_destroy();

                display_login();
            }
            else if($size == 0)  // This is the first time opening the site this session, or they didn't try to register.
            {
                display_login();
            }
            else   // User redirected here after registering
            {
                // Get users from database
                $db = mysqli_connect("127.0.0.1", "root", "password", "q5shopping");
                $query = "SELECT * FROM users";
                $users = mysqli_query($db, $query);
                $num_rows = mysqli_num_rows($users);

                // Get user input
                $userId = $_GET["userId"];
                $pwd = $_GET["pwd"];               
                $name = $_GET["name"];
                $address = $_GET["address"];
                $ccn = $_GET["ccn"];

                // Check whether id is already taken
                $idAlreadyTaken = false;
                for($i = 1; $i <= $num_rows; $i++)
                {
                    // Get user 
                    $row = mysqli_fetch_assoc($users);
                    $id = $row["id"];

                    if($id == $userId)  // ID is already taken
                    {
                        $idAlreadyTaken = true;
                        break;
                    }
                }

                if($idAlreadyTaken)     // User must choose new ID.
                {                
                    // Reprint registration page, keep other credentials in boxes.
                    print '
                    <h1>Register</h1>

                    <!-- User enters information and clicks submit to register -->
                    <form method="get" action="login.php">
                        <table>
                            <tr><td>User ID:&nbsp;</td><td><input id="userId" name="userId"></input></td></tr>
                            <tr><td>Password:&nbsp;</td><td><input name="pwd" value="'.$pwd.'"></input></td></tr>
                            <tr><td>Name:&nbsp;</td><td><input name="name" value="'.$name.'"></input></td></tr>
                            <tr><td>Address:&nbsp;</td><td><input name="address" value="'.$address.'"></input></td></tr>
                            <tr><td>Credit card number:&nbsp;</td><td><input name="ccn" value="'.$ccn.'"></input></tr></tr>
                            
                            <tr><td><input type="submit"></td></tr>
                        </table>
                    </form>

                    <a href="login.php"><button>Go to Login Page</button></a>';
                }
                else {  //User gave new, original ID
                    // Add user to database
                    $query = "INSERT into users(id, pwd, name, address, ccn) VALUES('$userId', '$pwd', '$name', '$address', '$ccn')";
                    mysqli_query($db, $query);

                    display_login();
                }
            }
        ?>
    </body>
</html>