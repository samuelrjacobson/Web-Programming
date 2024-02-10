<html>
<!DOCTYPE html>
<html>
<head> 
    <!-- Linking an external CSS file for styling -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Heading of the message board -->
    <h1>Message Board</h1>

    <!-- Table to display messages -->
    <table>
        <?php
            // Connect to the MySQL database
            $db = mysqli_connect("127.0.0.1", "root", "password2", "db1");
            
            // Prepare a query to select all messages from the 'messages' table
            $query = "SELECT * FROM messages";

            // Execute the query and store the result
            $result = mysqli_query($db, $query);

            // Get the number of rows returned by the query
            $num_rows = mysqli_num_rows($result);

            // Loop through each row in the result set
            for ($i = 0; $i < $num_rows; $i++)
            {
                // Fetch the next row as an associative array
                $row = mysqli_fetch_assoc($result);

                // Extract the date and message from the current row
                $date = $row["date"];
                $message = $row["message"];

                // Print the message and date in a table row
                print "<tr><td>";
                print "$message<br>";
                print "$date";
                print "</td></tr>";
            }
        ?>
    </table>
    <br>

    <!-- Form for submitting a new message -->
    <form method="get" action="http://localhost:8000/update.php">
        <!-- Text input for the message, limited in size and length -->
        <input type="text" size="100" maxlength="100" name="message"></input>
        <!-- Submit button for posting the message -->
        <input type="submit" value="Post Message"></input>
    </form>
</body>
</html>
