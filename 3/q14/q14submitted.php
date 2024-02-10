<!DOCTYPE HTML>
<!-- This file receives user input from q14survey.php and stores the survey answers to a database. -->
<html lang="en">
    <head>
        <title>Programming Survey</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Programming Survey</h1>

        <?php
            // Get passcode that user has entered
            $userInput = ($_GET["passcode"]);

            // Select passcodes table
            $db = mysqli_connect("127.0.0.1", "root", "password", "q14survey");
            $query = "SELECT * FROM passcodes";
            $passcodes = mysqli_query($db, $query);

            // Get number of passcodes to check, times to iterate
            $num_rows = mysqli_num_rows($passcodes);

            // Check whether the user entered a valid passcode
            $passcodeMatch = false;
            for($i = 1; $i <= $num_rows; $i++)
            {
                // Get passcode and used vs unused status
                $row = mysqli_fetch_assoc($passcodes);
                $passcode = $row["passcode"];
                $usedStatus = $row["status"];
                
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
                if($usedStatus == 'used')
                {
                    print "<p>Passcode has already been used.</p>";
                }
                // If passcode is valid and unused, update database and mark passcode as used
                else
                {
                    // Select questions table
                    $query = "SELECT * FROM questions";
                    $questions = mysqli_query($db, $query);

                    // For each question in database, check for yes/no response and increment counters
                    $num_rows = mysqli_num_rows($questions);
                    for($i = 1; $i <= $num_rows; $i++)
                    {
                        // Iterate through answers array to locate corresponding answer
                        foreach($_GET as $q => $a)
                        {
                            // If if's the next answer we're searching for, add answer to database
                            if($q == "q$i")
                            {
                                if($a == "yes") $query = "UPDATE questions SET yes = yes + 1 WHERE id = '$i'";
                                else if($a == "no") $query = "UPDATE questions SET no = no + 1 WHERE id = '$i'";
                                mysqli_query($db, $query);
                                break;
                            }
                        }
                    }

                    // Mark passcode as used
                    $query = "UPDATE passcodes SET status = 'used' WHERE passcode = '$passcode'";
                    mysqli_query($db, $query);

                    // Thank user
                    print "<p>Thank you for taking the survey! Your answers have been recorded.</p>";

                }
            }
        ?>
    </body>
</html>