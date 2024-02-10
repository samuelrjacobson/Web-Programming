<!DOCTYPE HTML>
<!--15. 
    This file creates a web page that receives input values from q10.html and uses them to calculate compound interest.
    The inputs to the calculation are the initial amount, interest rate, and number of years. .-->
<html lang="en">
    <head>
        <title>Your Compund Interest Calculation</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
            // Get the values to use in calculation
            $p = $_GET["p"];
            $r = $_GET["r"];
            $n = $_GET["n"];

            // Print values
            print "<p>Initial Amount: $p </p><br>";
            print "<p>Interest Rate: $r </p><br>";
            print "<p>Number of Years: $n </p><br>";
        
            // Perform calculation for each year up to n and print results as a table
            print "<table>";
            print "<tr><th>Year</th><th>Money</th></tr>";
            for ($i = 1; $i <= $n; $i++)
            {
                $total = $p * pow((1 + $r/100), $i);
                print '<tr onmouseover="changeColor(this)">';
                print "<td>$i</td>";
                print "<td>$total</td>";
                print "</tr>";
            }
            print "</table>";
        ?>
        <script>
            // When user hovers over a table row, change its background color
            function changeColor(row)
            {
                row.style.backgroundColor = "pink";
            }
        </script>
    </body>
</html>