<?php
    // so home page knows where we're redirecting to it from
    setcookie("origin", "profile");
    session_start();
?>
<!DOCTYPE HTML>
<!-- This file creates a web page for user profile at a shopping website. -->
<html lang="en">
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Profile</h1>
        
        <form method="get" action="home.php">
            <?php
                // Get user session information
                $userId = $_SESSION["userId"];
                $pwd = $_SESSION["pwd"];
                $name = $_SESSION["name"];
                $ccn = $_SESSION["ccn"];
                $address = $_SESSION["address"];

                // Display user information
                print '<table>';
                print '<tr><td><label>User ID</label></td>';
                print '<td><input readonly value="'.$userId.'" name="userId"></input></td></tr>';
                print '<tr><td><label>Password</label></td>';
                print '<td><input value="'.$pwd.'" name="pwd"></input></td></tr>';
                print '<tr><td><label>Name</label></td>';
                print '<td><input value="'.$name.'" name="name"></input></td></tr>';
                print '<tr><td><label>Address</label></td>';
                print '<td><input value="'.$address.'" name="address"></input></td></tr>';
                print '<tr><td><label>Credit card number</label></td>';
                print '<td><input value="'.$ccn.'" name="ccn"></input></td></tr>';
                print '</table>';
            ?>

            <!-- Form submission takes to home page -->
            <input type="submit" value="Update profile">
        </form>

        <!-- Link to home page -->
        <a href="home.php"><button>Home</button></a>
    </body>
</html>