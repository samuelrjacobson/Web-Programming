<?php

// Directly establish a connection to the database using mysqli_connect
$db = mysqli_connect('127.0.0.1', 'root', 'password', 'q4');

// Check if the data is submitted via POST method
$size = 0;
foreach ($_POST as $key=>$value) {
    $size++;
}
if($size > 0) {
    // Retrieve form data using POST method
    $userid = $_POST['userid'];
    $password = $_POST['password']; 
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Check if the user ID already exists
    $sql = "SELECT id FROM users WHERE id = '$userid'";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        // User ID exists, display an error message
        echo "<div class='alert alert-danger'>
                Invalid ID - User already exists.
              </div>";

    } else {
        // User ID does not exist, proceed to insert new user
        date_default_timezone_set("America/New_York");
        $time = date("Y/m/d h:i:sa");
        $insert_sql = "INSERT INTO users (id, password, name, email, visits, last) VALUES ('$userid', '$password', '$name', '$email', 0, '$time')";
        if (mysqli_query($db, $insert_sql) === TRUE) {
            // Successful insert, display confirmation
            echo "<div class='alert alert-success'>
                    Registration successful!
                  </div>
                  <a href='login.html' class='btn btn-primary'>Go to Login</a>";
        } else {
            // Display an error if the query failed
            echo "Error: " . $insert_sql . "<br>";
        }
    }

    // Close database connection
    mysqli_close($db);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Content here -->
    </div>
</body>
</html>
