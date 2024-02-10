<?php
    // Establishes a connection to the MySQL database using mysqli_connect.
    // Parameters include the server address, username, password, and the database name.
    $db = mysqli_connect("127.0.0.1", "root", "password2", "db3");

    // Retrieves the order ID from the POST request.
    // This ID is sent from the form where the user inputs the order ID they want to complete.
    $orderId = $_POST['order_id'];

    // Executes a SQL query to delete the order from the 'orders' table.
    // The query looks for a record where the 'auto_id' matches the provided order ID.
    mysqli_query($db, "DELETE FROM orders WHERE auto_id = '$orderId'");

    // Redirects the browser to 'orders.php'.
    // This is done after the order is deleted to refresh the page and show the updated list of orders.
    header("Location: orders.php");
?>
