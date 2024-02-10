<!DOCTYPE HTML>
<!-- This file creates an html page that receives a password from q14surveyor_login.php and,
    if the password is valid, displays the results of the survey (percent yes and no responses). -->
<html lang="en">
    <head>
        <title>Survey Results</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Programming Survey</h1>

        <?php
            // Get password from database
            $db = mysqli_connect("127.0.0.1", "root", "password", "q14survey");
            $query = "SELECT password FROM password";
            $passwordTable = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($passwordTable);
            $validPassword = $row["password"];

            // Check password validity
            if ($_GET["password"] != $validPassword)
            {
                print "Invalid password";
            }
            else { // If password is valid
                // Select questions table from database
                $query = "SELECT * FROM questions";
                $questions = mysqli_query($db, $query);

                // Show table with percent yes responses and no responses
                // table header
                print "<table><tr>";
                print "<th>Question</th>";
                print "<th>Yes</th>";
                print "<th>No</th></tr>";

                // For each question, get data
                $num_rows = mysqli_num_rows($questions);
                for($i = 1; $i <= $num_rows; $i++)
                {
                    $row = mysqli_fetch_assoc($questions);

                    // Get number of yes and no and calculate percents
                    $q = $row["question"];
                    $y = $row["yes"];
                    $n = $row["no"];
                    $percentY = $y/($y + $n);
                    $percentN = $n/($y + $n);

                    // Print results to table
                    print "<tr>";
                    print "<td>$q</td>";
                    print "<td>$percentY%</td>";
                    print "<td>$percentN%</td>";
                    print "</tr>";
            
                }
                print "</table>";
            }
        ?>
    </body>
</html>