<?php
    // so home page knows where we're redirecting to it from
    setcookie("origin", "order-confirmation");
    session_start();
?>
<!DOCTYPE HTML>
<!-- This file creates a web page for order confirmation at a shop. -->
<html lang="en">
    <head>
        <title>Order Confirmation</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Order Confirmation</h1>
        
        <?php
            // Get user session information
            $userId = $_SESSION["userId"];
            $ccn = $_SESSION["ccn"];
            $address = $_SESSION["address"];

            // Get shop items from database
            $db = mysqli_connect("127.0.0.1", "root", "password", "q5shopping");
            $query = "SELECT * FROM items";
            $items = mysqli_query($db, $query);

            // Table header row
            print "<table><tr><th>Item</th><th>Price (USD)</th><th>Quantity</th><th>Order Cost (USD)</tr>";

            // Populate table with items
            $num_rows = mysqli_num_rows($items);
            $totalCost = 0;
            for($i = 1; $i <= $num_rows; $i++)
            {
                $row = mysqli_fetch_assoc($items);

                // Get item 
                if(isset($_GET["item$i"]) && $_GET["item$i"] == "on") // This is one order.
                {
                    // Get item information
                    $itemId = $row["id"];
                    $name = $row["name"];
                    $price = $row["price"];
                    $quantity = (int)$_GET["quantity$i"];
                    $orderCost = $price * $quantity;

                    // Add order to MySQL table
                    $query = "INSERT into orders(userId, itemId, num, shipStatus) VALUES('$userId', '$itemId', '$quantity', 'Not')";
                    mysqli_query($db, $query);

                    // Display order
                    print "<tr>";
                    print "<td>$name</td>";
                    print "<td>$price</td>";
                    print "<td>$quantity</td>";
                    print "<td>$orderCost</td>";
                    
                    $totalCost += $orderCost;
                }
            }
            print "</table>";

            // Print total, ccn, address   
            print "<p>Total Cost: $totalCost</p>";
            print "<p>Credit card number: $ccn</p>";
            print "<p>Address: $address</p>";
        ?>

        <!-- Link to home page -->
        <a href="home.php"><button>Home</button></a>
    </body>
</html>