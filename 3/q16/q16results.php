<!DOCTYPE HTML>
<!-- This file creates an html page that receives a password from q16examiner_login.php and,
    if the password is valid, displays the results of the exam (scores of students). -->
<html lang="en">
    <head>
        <title>Exam Results</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Exam</h1>
        
        <?php
            // Get valid password from database
            $db = mysqli_connect("127.0.0.1", "root", "password", "q16exam");
            $query = "SELECT password FROM password";
            $passwordTable = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($passwordTable);
            $validPassword = $row["password"];

            // Check validity of user's entered password
            if ($_GET["password"] != $validPassword)
            {
                print "Invalid password";
            }
            else { // If password is valid
                // Select students table from database
                $query = "SELECT * FROM students";
                $students = mysqli_query($db, $query);

                // Show table with student name, passcode, status (taken exam or not), and score
                // table header
                print "<table><tr>";
                print "<th>Name</th>";
                print "<th>Passcode</th>";
                print "<th>Status</th>";
                print "<th>Score</th></tr>";

                // For each student, get data
                $num_rows = mysqli_num_rows($students);
                for($i = 1; $i <= $num_rows; $i++)
                {
                    $row = mysqli_fetch_assoc($students);

                    // Get attributes from table
                    $name = $row["name"];
                    $passcode = $row["code"];
                    $status = $row["status"];
                    $score = $row["score"];

                    // Print results to table
                    print "<tr>";
                    print "<td>$name</td>";
                    print "<td>$passcode</td>";
                    print "<td>$status</td>";
                    print "<td>$score</td>";
                    print "</tr>";
                }
                print "</table>";
            }
        ?>
    </body>
</html>