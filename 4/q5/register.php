<?php
    // So login page knows where we're coming from
    setcookie("origin-is-home", "false");
    setcookie("origin-is-register", "true");
?>
<!DOCTYPE HTML>
<!-- This file creates a web page for registration to a shopping site. -->
<html lang="en">
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Register</h1>

        <!-- User enters information and clicks submit to register -->
        <form method="get" action="login.php">
            <table>
                <tr><td>User ID:&nbsp;</td><td><input id="userId" name="userId"></input></td></tr>
                <tr><td>Password:&nbsp;</td><td><input name="pwd"></input></td></tr>
                <tr><td>Name:&nbsp;</td><td><input name="name"></input></td></tr>
                <tr><td>Address:&nbsp;</td><td><input name="address"></input></td></tr>
                <tr><td>Credit card number:&nbsp;</td><td><input name="ccn"></input></tr></tr>
                
                <tr><td><input type="submit"></td></tr>
            </table>
        </form>

        <!-- Link to login page -->
        <a href="login.php"><button>Go to Login Page</button></a>
   
    </body>
</html>