<?php
    // so home page knows where we're redirecting to it from
    setcookie("origin", "orders");
    session_start();
?>
<!DOCTYPE HTML>
<!-- This file creates a web page showing a user's orders. -->
<html lang="en">
    <head>
        <title>Orders</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Orders</h1>
        
        <?php
            $userId = $_SESSION["userId"];

            // Get shop items from database
            $db = mysqli_connect("127.0.0.1", "root", "password", "q5shopping");
            $query = "SELECT * FROM orders where userId = $userId";
            $orders = mysqli_query($db, $query);
            
            // Table header row
            print "<table><tr><th>Item</th><th>Price</th><th>Quantity</th><th>Order Price</th><th>Shipping Status</th></tr>";

            // Populate table with orders
            $num_rows = mysqli_num_rows($orders);
            for($i = 1; $i <= $num_rows; $i++)
            {
                // Get order information
                $row = mysqli_fetch_assoc($orders);
                $itemId = $row["itemId"];
                $quantity = $row["num"];
                $shipStatus = $row["shipStatus"];

                // Get item information
                $query = "SELECT * from items where id = $itemId";
                $items = mysqli_query($db, $query);
                $itemRow = mysqli_fetch_assoc($items);
                $itemCost = $itemRow["price"];
                $itemName = $itemRow["name"];
                $orderCost = $itemCost * $quantity;

                // Display order
                print "<tr>";
                print "<td>$itemName</td>";
                print "<td>$itemCost</td>";
                print "<td>$quantity</td>";
                print "<td>$orderCost</td>";
                print "<td>$shipStatus</td>";   
            }
        ?>
        </table>

        <!-- Link to home page -->
        <a href="home.php"><button>Home</button></a>
    </body>
</html>