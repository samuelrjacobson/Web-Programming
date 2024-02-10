<!DOCTYPE HTML>
<!-- This file creates an html page that accepts a password and sends it to
    q14results.php for validation, to access survey results page. -->
<html lang="en">
    <head>
        <title>Surveyor Login</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Programming Survey</h1>

        <!-- Surveyor signs in with password, directed to q14results.php -->
        <form method="get" action="q14results.php">
            <label>Enter password:&nbsp;</label><input name ="password"></input>
            <input type="submit">
        </form>
    </body>
</html>