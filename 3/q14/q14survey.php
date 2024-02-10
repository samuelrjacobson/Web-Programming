<!DOCTYPE HTML>
<!-- This file creates a web page with survey questions and sends the user input to q14submitted.php. -->
<html lang="en">
    <head>
        <title>Programming Survey</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Programming Survey</h1>

        <!-- Send survey answers to q14submitted.php -->
        <form method="get" action="q14submitted.php">

            <?php
                // Get survey questions from database
                $db = mysqli_connect("127.0.0.1", "root", "password", "q14survey");
                $query = "SELECT * FROM questions";
                $questions = mysqli_query($db, $query);

                // Populate table with questions from database
                $num_rows = mysqli_num_rows($questions);
                print "<table>";
                for($i = 1; $i <= $num_rows; $i++)
                {
                    // Get question 
                    $row = mysqli_fetch_assoc($questions);
                    $q = $row["question"];

                    print "<tr>";
                    print "<td>$q</td>";    // First column of tables has questions.

                    // Radio buttons--user chooses yes or no
                    $name = "q$i";  // q1, q2, q3...
                    print '<td><input type="radio" name='.$name.' value="yes">Yes</input></td>';
                    print '<td><input type="radio" name='.$name.' value="no">No</input></td></tr>';
                }
                print "</table>";
            ?>

            <!-- Text box for passcode -->
            <label>Passcode</label><input name="passcode"></input>

            <input type="submit">
            <input type="reset">
        </form>
    </body>
</html>