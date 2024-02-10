<!DOCTYPE HTML>
<!-- This file receives user input from q16exam.php and stores the exam answers in a database. -->
<html lang="en">
    <head>
        <title>Exam</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Exam</h1>
        
        <?php
            // Get passcode that user has entered
            $userInput = ($_GET["passcode"]);

            // Select students table
            $db = mysqli_connect("127.0.0.1", "root", "password", "q16exam");
            $query = "SELECT * FROM students";
            $students = mysqli_query($db, $query);

            // Get number of passcodes to check, times to iterate
            $num_rows = mysqli_num_rows($students);

            // Check whether the user entered a valid passcode
            $passcodeMatch = false;
            for($i = 1; $i <= $num_rows; $i++)
            {
                // Get passcode and done vs not done status
                $row = mysqli_fetch_assoc($students);
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
                // If passcode is valid and unused, update database and mark passcode as used
                else
                {
                    // Select questions table
                    $query = "SELECT * FROM questions";
                    $questions = mysqli_query($db, $query);

                    // For each question in database, check answer and increment counters
                    $num_rows = mysqli_num_rows($questions);
                    for($i = 1; $i <= $num_rows; $i++)
                    {
                        // Get correct answer
                        $row = mysqli_fetch_assoc($questions);
                        $correctAnswer = $row["correct"];

                        // Iterate through answers array to locate corresponding answer
                        foreach($_GET as $q => $a)
                        {
                            // If if's the next question we're searching for, check answer
                            if($q == "q$i")
                            {
                                //print "Answer: $a Correct: $correctAnswer";
                                if($a == $correctAnswer)
                                {
                                    $query = "UPDATE students SET score = score + 1 WHERE code = '$passcode'";
                                    mysqli_query($db, $query);
                                }
                                break;
                            }
                        }
                    }

                    // Mark exam as completed for student
                    $query = "UPDATE students SET status = 'Done' WHERE code = '$passcode'";
                    mysqli_query($db, $query);

                    // Thank user
                    print "<p>Finished! Your answers have been recorded.</p>";
                }
            }
        ?>
    </body>
</html>