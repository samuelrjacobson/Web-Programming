<!DOCTYPE HTML>
<!-- This file creates a webpage for administrators of a shopping site. Redirected here from store-home.php, lets user perform actions. -->
<html lang="en">
    <head>
        <title>Store Action</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Action Completed!</h1>

        <?php
            // Check passcode
            if($_GET["passcode"] != "1234")
            {
                print "<p>Invalid passcode</p>";
            }
            else {

                // Connect to database
                $db = mysqli_connect("127.0.0.1", "root", "password", "q5shopping");

                // Display all users
                if($_GET["action"] == "display_users")
                {
                    // Get users from database
                    $query = "SELECT * FROM users";
                    $users = mysqli_query($db, $query);

                    // Table header row
                    print "<table><tr><th>User ID</th><th>User Name</th><th>Address</th><th>Credit card number</th></tr>";

                    // Populate table with users
                    $num_rows = mysqli_num_rows($users);
                    for($i = 1; $i <= $num_rows; $i++)
                    {
                        // Get user information
                        $row = mysqli_fetch_assoc($users);
                        $userId = $row["id"];
                        $name = $row["name"];
                        $address = $row["address"];
                        $ccn = $row["ccn"];

                        // Display user
                        print "<tr>";
                        print "<td>$userId</td>";
                        print "<td>$name</td>";
                        print "<td>$address</td>";
                        print "<td>$ccn</td></tr>";                    
                    }
                    print "</table>";
                }
                // Display all items in store
                else if($_GET["action"] == "display_items")
                {
                    // Get shop items from database
                    $query = "SELECT * FROM items";
                    $items = mysqli_query($db, $query);

                    // Table header row
                    print "<table><tr><th>Item ID</th><th>Item name</th><th>Price (USD)</th></tr>";

                    // Populate table with items
                    $num_rows = mysqli_num_rows($items);
                    for($i = 1; $i <= $num_rows; $i++)
                    {
                        // Get item information
                        $itemRow = mysqli_fetch_assoc($items);
                        $itemId = $itemRow["id"];
                        $itemCost = $itemRow["price"];
                        $itemName = $itemRow["name"];

                        // Display item
                        print "<tr>";
                        print "<td>$itemId</td>";
                        print "<td>$itemName</td>";
                        print "<td>$itemCost</td></tr>";                   
                    }
                    print "</table>";
                }
                // Display all placed orders
                else if($_GET["action"] == "display_orders")
                {
                    // Get orders from database
                    $query = "SELECT * FROM orders";
                    $orders = mysqli_query($db, $query);

                    // Table header row
                    print "<table><tr><th>Order ID</th><th>User name</th><th>Item Name
                    </th><th>Quantity</th><th>Total Cost (USD)</th><th>Shipping status</th></tr>";

                    // Populate table with orders
                    $num_rows = mysqli_num_rows($orders);
                    for($i = 1; $i <= $num_rows; $i++)
                    {
                        // Get order information
                        $row = mysqli_fetch_assoc($orders);
                        $orderId = $row["id"];
                        $itemId = $row["itemId"];
                        $userId = $row["userId"];
                        $quantity = $row["num"];
                        $shipStatus = $row["shipStatus"];

                        // Get item information
                        $query = "SELECT * from items where id = $itemId";
                        $items = mysqli_query($db, $query);
                        $itemRow = mysqli_fetch_assoc($items);
                        $itemCost = $itemRow["price"];
                        $itemName = $itemRow["name"];
                        $orderCost = $itemCost * $quantity;

                        // Get user information
                        $query = "SELECT * from users where id = $userId";
                        $users = mysqli_query($db, $query);
                        $userRow = mysqli_fetch_assoc($users);
                        $userName = $userRow["name"];

                        // Display order
                        print "<tr>";
                        print "<td>$orderId</td>";
                        print "<td>$userName</td>";
                        print "<td>$itemName</td>";
                        print "<td>$quantity</td>";
                        print "<td>$orderCost</td>";
                        print "<td>$shipStatus</td></tr>";
                    }
                    print "</table>";
                }
                // Display all unshipped orders
                else if($_GET["action"] == "display_unshipped_orders")
                {
                    // Get orders from database
                    $query = "SELECT * FROM orders where shipStatus = 'Not'";
                    $orders = mysqli_query($db, $query);

                    // Table header row
                    print "<table><tr><th>Order ID</th><th>Item Name</th><th>Quantity</th><th>
                    Total Cost (USD)</th><th>User name</th><th>Address</th><th>Credit card number</th></tr>";

                    // Populate table with orders
                    $num_rows = mysqli_num_rows($orders);
                    for($i = 1; $i <= $num_rows; $i++)
                    {
                        // Get order information
                        $row = mysqli_fetch_assoc($orders);
                        $orderId = $row["id"];
                        $itemId = $row["itemId"];
                        $userId = $row["userId"];
                        $quantity = $row["num"];

                        // Get item information
                        $query = "SELECT * from items where id = $itemId";
                        $items = mysqli_query($db, $query);
                        $itemRow = mysqli_fetch_assoc($items);
                        $itemCost = $itemRow["price"];
                        $itemName = $itemRow["name"];
                        $orderCost = $itemCost * $quantity;

                        // Get user information
                        $query = "SELECT * from users where id = $userId";
                        $users = mysqli_query($db, $query);
                        $userRow = mysqli_fetch_assoc($users);
                        $userName = $userRow["name"];
                        $address = $userRow["address"];
                        $ccn = $userRow["ccn"];

                        // Display order
                        print "<tr>";
                        print "<td>$orderId</td>";
                        print "<td>$itemName</td>";
                        print "<td>$quantity</td>";
                        print "<td>$orderCost</td>";
                        print "<td>$userName</td>";
                        print "<td>$address</td>";
                        print "<td>$ccn</td></tr>";
                    }
                    print "</table>";
                }
                // Mark an order as having been shipped
                else if($_GET["action"] == "ship_order")
                {
                    $orderId = $_GET["orderId"];
                    $query = "UPDATE orders SET shipStatus = 'Done' where id = '$orderId'";
                    mysqli_query($db, $query);
                }
                // Add an item to store
                else if($_GET["action"] == "add_item")
                {
                    $itemId = $_GET["add_itemId"];
                    $itemName = $_GET["item_name"];
                    $itemPrice = $_GET["item_price"];

                    $query = "INSERT INTO items(id, name, price) VALUES('$itemId', '$itemName', '$itemPrice')";
                    mysqli_query($db, $query);
                }
                // Remove an item from store
                else if($_GET["action"] == "remove_item")
                {
                    $itemId = $_GET["rm_itemId"];

                    $query = "DELETE from items where id = '$itemId'";
                    mysqli_query($db, $query);
                }
            }
        ?>

        <!-- Link to home page -->
        <a href="store-home.php"><button>Home</button></a>
    </body>
</html>