<!DOCTYPE html>
<!-- Defines the document type and version of HTML -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Ensures proper rendering and touch zooming on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
    // Establishes a connection to the MySQL database
    $db = mysqli_connect("127.0.0.1", "root", "password2", "db3");

    // Retrieves form data sent via POST request
    $name = $_POST['name'];       // Customer's name
    $card = $_POST['card'];       // Customer's card number
    $address = $_POST['address']; // Customer's address

    // Checks if food items were selected and assigns them a value (1 or 0)
    $noodles = isset($_POST['noodles']) ? 1 : 0;
    $rice = isset($_POST['rice']) ? 1 : 0;
    $hotpot = isset($_POST['hotpot']) ? 1 : 0;

    // Array to store the prices of each food item
    $prices = ['noodles' => 5, 'rice' => 3, 'hotpot' => 10];
    $totalCost = 0; // Variable to hold the total cost

    // Calculate the total cost based on selected items
    if ($noodles) $totalCost += $prices['noodles'];
    if ($rice) $totalCost += $prices['rice'];
    if ($hotpot) $totalCost += $prices['hotpot'];

    // SQL query to insert the order data into the 'orders' table
    $query = "INSERT INTO orders (name, card, address, noodles, rice, hotpot) VALUES ('$name', '$card', '$address', '$noodles', '$rice', '$hotpot')";
    mysqli_query($db, $query); // Executes the SQL query

    // Display a confirmation message with order details in a table
    echo "<h1>Order Confirmation</h1>";
    echo "<table>";
    echo "<tr><td>Name:</td><td>$name</td></tr>";
    echo "<tr><td>Card Number:</td><td>$card</td></tr>";
    echo "<tr><td>Address:</td><td>$address</td></tr>";
    echo "<tr><td>Noodles:</td><td>" . ($noodles ? "Yes ($" . $prices['noodles'] . ")" : "No") . "</td></tr>";
    echo "<tr><td>Rice:</td><td>" . ($rice ? "Yes ($" . $prices['rice'] . ")" : "No") . "</td></tr>";
    echo "<tr><td>Hotpot:</td><td>" . ($hotpot ? "Yes ($" . $prices['hotpot'] . ")" : "No") . "</td></tr>";
    echo "<tr><td>Total Cost:</td><td>$$totalCost</td></tr>";
    echo "</table>";
?>

</body>
</html>
