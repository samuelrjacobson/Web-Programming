<?php
    // Connect to the database
    $db = mysqli_connect("127.0.0.1", "root", "password2", "db1");

    // Get the message from the GET array and sanitize it
    $message = mysqli_real_escape_string($db, $_GET["message"]);

    date_default_timezone_set("America/New_York"); // set time zone
    // Get the current date and time
    $date = date("Y-m-d H:i:s");

    // SQL query to insert the new message
    $query = "INSERT INTO messages (message, date) VALUES ('$message', '$date')";

    // Execute the query
    mysqli_query($db, $query);

    // Redirect back to board.php
    header("Location: board.php");
?>
