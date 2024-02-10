<!DOCTYPE HTML>
<!-- This file creates a home page for administrators of a shopping site. -->
<html lang="en">
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Home</h1>

        <!-- User selects action to perform and enters passcode to verify -->
        <form method="get" action="store-actions.php">
            <!-- Display data -->
            <input type="radio" name="action" value="display_users">Display all users</input><br>
            <input type="radio" name="action" value="display_items">Display all items</input><br>
            <input type="radio" name="action" value="display_orders">Display all orders</input><br>
            <input type="radio" name="action" value="display_unshipped_orders">Display unshipped orders</input><br><br>

            <!-- Ship an order -->
            <input type="radio" name="action" value="ship_order">Ship an order</input><br>
            <label>Enter order ID:&nbsp;</label><input name="orderId"></input><br><br>

            <!-- Add an item to store -->
            <input type="radio" name="action" value="add_item">Add an item</input><br>
            <label>Item ID:&nbsp;</label><input name="add_itemId"></input><br>
            <label>Item name:&nbsp;</label><input name="item_name"></input><br>
            <label>Item price:&nbsp;</label><input name="item_price"></input><br><br>

            <!-- Remove an item from store -->
            <input type="radio" name="action" value="remove_item">Remove an item</input><br>
            <label>Item ID:&nbsp;</label><input name="rm_itemId"></input><br><br>
            
            <!-- Passcode --> 
            <label>Passcode:&nbsp;</label><input name="passcode"></input>

            <!-- Takes user to actions page and performs action --> 
            <input type="submit">
        </form>   
    </body>
</html>