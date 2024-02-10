<?php
    // This file creates a home page for a shopping site.
    session_start();
    setcookie("origin-is-home", "true");
    setcookie("origin-is-register", "false");

    function display_home()
    {
        // Display home page
        print '
        <!DOCTYPE HTML>
        <html lang="en">
            <head>
                <title>Home</title>
                <link rel="stylesheet" href="style.css">
            </head>
            <body>

                <a href="shop.php"><button>Shop</button></a><br><br>

                <a href="orders.php"><button>Orders</button></a><br><br>

                <a href="profile.php"><button>Profile</button></a><br><br><br>

                <a href="login.php"><button class="white">Log out</button></a>
            </body>
        </html>';
    }

    // Connect to database
    $db = mysqli_connect("127.0.0.1", "root", "password", "q5shopping");

    // Determine where we redirected to here from
    $size = 0;
    foreach ($_GET as $key=>$value)
    {
        $size++;
    }
    if($_COOKIE["origin"] == "profile" && $size > 0)    // If user just updated profile
    {
        // Get new profile information
        $userId = $_GET["userId"];
        $pwd = $_GET["pwd"];
        $name = $_GET["name"];
        $ccn = $_GET["ccn"];
        $address = $_GET["address"];

        // Update user data in database
        $query = "UPDATE users SET pwd='$pwd', name='$name', ccn='$ccn', address='$address' WHERE id='$userId'";
        mysqli_query($db, $query);

        // Update session info
        $_SESSION["userId"] = $userId;
        $_SESSION["pwd"] = $pwd;
        $_SESSION["name"] = $name;
        $_SESSION["ccn"] = $ccn;
        $_SESSION["address"] = $address;

        display_home();
    }
    else if($_COOKIE["origin"] == "login")  // If user just tried to log in
    {
        // Get users from database
        $query = "SELECT * FROM users";
        $users = mysqli_query($db, $query);
        $num_rows = mysqli_num_rows($users);

        // Check whether id is already taken
        $success = false;
        for($i = 1; $i <= $num_rows; $i++)
        {
            // Get user
            $row = mysqli_fetch_assoc($users);
            $id = $row["id"];
            $pwd = $row["pwd"];

            // Check if ID and password match
            if($id == $_GET["userId"] && $pwd = $_GET["pwd"])
            {
                $success = true;
                break;
            }
        }

        if($success)    // Successful login
        {
            // Set session variables of user's information
            $_SESSION["userId"] = $id;
            $_SESSION["pwd"] = $pwd;
            $_SESSION["name"] = $row["name"];
            $_SESSION["address"] = $row["address"];
            $_SESSION["ccn"] = $row["ccn"];

            display_home();
        }

        else     // If login input is invalid, re-display login page
        {
            print '
            <!DOCTYPE HTML>
            <html lang="en">
                <head>
                    <title>Login</title>
                    <link rel="stylesheet" href="style.css">
                </head>
                <body>
                    <h1>Login</h1>

                    <!-- User enters information and clicks submit to register -->
                    <form method="get" action="home.php">
                        <table>
                            <tr><td>User ID:&nbsp;</td><td><input id="userId" name="userId"></input></td></tr>
                            <tr><td>Password:&nbsp;</td><td><input name="pwd"></input></td></tr>
                            
                            <tr><td><input onclick="clear()" type="submit"></td></tr>
                        </table>
                    </form>

                    <a href="register.php"><button>Go to Registration Page</button></a>
                </body>
            </html>';
        }
    }
    else {
        display_home();
    }
?>