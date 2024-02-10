<!DOCTYPE HTML>
<!-- This file creates a web page for user to take exam. -->
<html lang="en">
    <head>
        <title>Exam</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Exam</h1>
        
        <form method="get" action="q16submitted.php">
            <?php
                // Get passcode that user has entered
                $userInput = ($_GET["passcode"]);
        
                // Select students table
                $db = mysqli_connect("127.0.0.1", "root", "password", "q16exam");
                $query = "SELECT * FROM students";
                $passcodes = mysqli_query($db, $query);
        
                // Get number of passcodes to check, times to iterate
                $num_rows = mysqli_num_rows($passcodes);
        
                // Check whether the user entered a valid passcode
                $passcodeMatch = false;
                for($i = 1; $i <= $num_rows; $i++)
                {
                    // Get passcode and used vs unused status
                    $row = mysqli_fetch_assoc($passcodes);
                    $passcode = $row["code"];
                    $hasCompleted = $row["status"];
                        
                    // Continue checking passcodes till there is a match or we run out of passcodes
                    if($passcode == $userInput)
                    {
                        $passcodeMatch = true;
                        break;
                    }
                }
        
                // If user gave invalid passcode
                if(!$passcodeMatch)
                {
                    print "<p>Invalid passcode</p>";
                }
                else
                {
                    // If the user gave a passcode that has already been used
                    if($hasCompleted == 'Done')
                    {
                        print "<p>You have already taken the exam.</p>";
                    }
                    // If passcode is valid and unused, display exam
                    else
                    {
                        // Get survey questions from database
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

                            // Print one question and answers per row
                            print "<tr>";
                            print "<td>$q";

                            // Radio buttons--user chooses answer. Each answer is on its own line, but in the same row.
                            $name = "q$i";  // q1, q2, q3...
                            for($j = 1; $j <= 4; $j++)
                            {
                                $answer = $row["answer$j"];
                                print '<br><input type="radio" name='.$name.' value='.$j.'>'.$answer.'</input>';
                                //print '<td><input type="radio" name='.$name.' value="no">No</input></td>';
                            }
                            print "</tr>";
                        }
                        print "</table>";

                        // Text box for passcode
                        print '<label>Passcode</label><input name="passcode"></input>';
                           
                        // Submit exam
                        print '<input type="submit">';
                    }
                }
            ?>
        </form>
    </body>
</html>