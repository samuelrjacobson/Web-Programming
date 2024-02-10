<?php
    // so home page knows where we're redirecting to it from
    setcookie("origin", "shop");
?>
<!DOCTYPE HTML>
<!-- This file creates a web page for user to shop for items. -->
<html lang="en">
    <head>
        <title>Shop</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Shop</h1>
        
        <form method="get" action="order_confirmation.php">
            <?php
                // Get shop items from database
                $db = mysqli_connect("127.0.0.1", "root", "password", "q5shopping");
                $query = "SELECT * FROM items";
                $items = mysqli_query($db, $query);

                // Table header row
                print "<table><tr><th>Item</th><th>Price (USD)</th><th>Quantity</th></tr>";

                // Populate table with items
                $num_rows = mysqli_num_rows($items);
                for($i = 1; $i <= $num_rows; $i++)
                {
                    // Get item 
                    $row = mysqli_fetch_assoc($items);
                    $item = $row["name"];
                    $price = $row["price"];
                    $name = "item$i";  // item1, item2, item3...
                    $quantity = "quantity$i"; // Amount of item i that user gets

                    // Print one item per row
                    print "<tr>";
                    print '<td><input type="checkbox" name="'.$name.'"></td>';
                    print "<td>$item</td>";
                    print "<td>$price</td>";
                    print '<td><input name="'.$quantity.'"></input></td></tr>';
                }
            ?>
            </table>

            <!-- Form submission takes to order confirmation -->
            <input type="submit">
        </form>

        <!-- Link to home page -->
        <a href="home.php"><button>Home</button></a>
    </body>
</html>