<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
// Start the session
session_start();

// Connect to the MySQL database using mysqli
// Parameters: host, username, password, database name
$db = mysqli_connect("127.0.0.1", "root", "password2", "db3");

// Check if the user is already logged in or if a password is submitted
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // User is already logged in, display orders
    displayOrders($db);
} elseif (isset($_POST['password'])) {
    // Password is submitted, validate it
    $enteredPassword = $_POST['password'];
    $result = mysqli_query($db, "SELECT pwd FROM password");
    $row = mysqli_fetch_assoc($result);

    if ($enteredPassword == $row['pwd']) {
        // Correct password, set session variable and display orders
        $_SESSION['logged_in'] = true;
        displayOrders($db);
    } else {
        // Incorrect password, display an error message
        echo "Invalid password.";
    }
} else {
    // No password submitted and not logged in, request for password
    echo "Password is required.";
}

// Function to display orders in single column format
function displayOrders($db) {
    $orders = mysqli_query($db, "SELECT * FROM orders");
    echo "<table>";

    while ($order = mysqli_fetch_assoc($orders)) {
        // Calculate the total cost for each order
        $totalCost = ($order['noodles'] ? 5 : 0) + ($order['rice'] ? 3 : 0) + ($order['hotpot'] ? 10 : 0); // Assuming prices for noodles, rice, and hotpot are $5, $3, and $10 respectively

        echo "<tr><td>";
        echo "ID: " . $order['auto_id'] . "<br>";
        echo "Noodles: " . ($order['noodles'] ? "Yes" : "No") . "<br>";
        echo "Rice: " . ($order['rice'] ? "Yes" : "No") . "<br>";
        echo "Hotpot: " . ($order['hotpot'] ? "Yes" : "No") . "<br>";
        echo "Total Cost: $" . $totalCost . "<br>";
        echo "Name: " . $order['name'] . "<br>";
        echo "Card Number: " . $order['card'] . "<br>";
        echo "Address: " . $order['address'] . "<br>";
        echo "</td></tr>";
    }

    echo "</table>";


    // Heading for the order completion section
    echo "<h2>Complete an Order</h2>";

    // Form for submitting the ID of the order to be completed
    echo "<form action='http://localhost:8000/update.php' method='post'>";
    
    // Input field for the user to enter the ID of the order they wish to complete
    echo "Order ID to complete: <input type='text' name='order_id'>";

    // Submit button for the form
    echo "<input type='submit' value='Complete Order'>";

    // Closing the form tag
    echo "</form>";


}

?>

</body>
</html>
