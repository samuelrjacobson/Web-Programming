<!DOCTYPE HTML>
<html>
    <head>
        <title>Tuition Calculation</title>
        <link rel="stylesheet" href="style.css">

    </head>
    <body>
        <h1>Tuition Calculation</h1>

        <?php
            // Initialize variables

            // Initialize and process input variables
            $credits = isset($_POST["credits"]) ? (int)$_POST["credits"] : 0; 
            // Check if 'credits' is set in POST data. If set, cast it to an integer; otherwise, default to 0.

            $gradStatus = isset($_POST["gradStatus"]) ? $_POST["gradStatus"] : "";
            // Check if 'gradStatus' (Undergraduate/Graduate status) is set in POST data. If set, use its value; otherwise, default to an empty string.

            $stateStatus = isset($_POST["stateStatus"]) ? $_POST["stateStatus"] : "";
            // Check if 'stateStatus' (In-state/Out-of-state status) is set in POST data. If set, use its value; otherwise, default to an empty string.

            $errors = []; 
            // Initialize an empty array to hold any validation errors that might occur.


            // Validate credits input
            if ($credits <= 0 || $credits > 18) {
                $errors[] = "Credits must be a positive integer between 1 and 18.";
            }

            // Validate academic status input
            if ($gradStatus == "") {
                $errors[] = "Academic status is required.";
            }

            // Validate state status input
            if ($stateStatus == "") {
                $errors[] = "State status is required.";
            }

            // Check for dorm, dining, and parking options
            $dorm = isset($_POST["dorm"]) ? 1000 : 0;
            $dine = isset($_POST["dine"]) ? 500 : 0;
            $park = isset($_POST["park"]) ? 200 : 0;

            // Check if there are errors
            if (count($errors)== 0) {
                // Calculate tuition based on academic and state status
                $tuition = 0;
                if ($gradStatus == "Undergraduate") {
                    $tuition = ($stateStatus == "Instate") ? 200 : 400;
                } else {
                    $tuition = ($stateStatus == "Instate") ? 300 : 600;
                }
                $tuitionTotal = $tuition * $credits;

                // Calculate total cost
                $totalCost = $tuitionTotal + $dorm + $dine + $park;

                // Display the itemized bill in a table
                echo '<table>';
                echo '<tr><th>Credits</th><td>' . $credits . '</td></tr>';
                echo '<tr><th>Academic Status</th><td>' . $gradStatus . '</td></tr>';
                echo '<tr><th>State Status</th><td>' . $stateStatus . '</td></tr>';
                echo '<tr><th>Tuition</th><td>$' . $tuitionTotal . '</td></tr>';
                echo '<tr><th>Dorm</th><td>$' . $dorm . '</td></tr>';
                echo '<tr><th>Dining</th><td>$' . $dine . '</td></tr>';
                echo '<tr><th>Parking</th><td>$' . $park . '</td></tr>';
                echo '<tr><th>Total Cost</th><td>$' . $totalCost . '</td></tr>';
                echo '</table>';
            } else {
                // Display error messages if there are validation errors
                echo '<div class="error">';
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
                echo '</div>';
            }
        ?>
    </body>
</html>
