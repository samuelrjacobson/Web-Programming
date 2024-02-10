<?php
// Start a session to access session variables
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['userid']);

// Establish a database connection only if the user is logged in
if ($loggedIn) {
    $userid = $_SESSION['userid'];

    // Set the default time zone to Detroit's time zone
    date_default_timezone_set('America/Detroit');
    
    // Connect to the database using mysqli_connect
    $db = mysqli_connect('127.0.0.1', 'root', 'password', 'q4');
    
    // Format the current time as a string
    $currentTime = date("Y-m-d H:i:s");

    // Update the 'last' field in the database with the formatted time
    $updateQuery = "UPDATE users SET last = '{$currentTime}' WHERE id = '{$userid}'";
    mysqli_query($db, $updateQuery);

    // Fetch user details from the database
    $query = "SELECT name, email, visits, last FROM users WHERE id = '{$userid}'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $email = $row['email'];
        $visits = $row['visits'];
        $last = $row['last']; // This is already in 'America/Detroit' time
    } else {
        echo "User not found.";
        //exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <!-- Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php 
            if ($loggedIn) {
                print '
                <h2>User Profile</h2>
                <!-- Display user details -->
                <p>Name: '.$name.'</p>
                <p>Email: '.$email.'</p>
                <p>Number of Visits: '.$visits.'</p>
                <p>Last Visit: '.$last.'</p>

                <!-- Navigation buttons -->
                <a href="home.php" class="btn btn-primary">Home</a>
                <a href="profile.php" class="btn btn-secondary">Profile</a>
                <a href="logout.php" class="btn btn-danger">Logout</a>';
            }
            else {
                print '
                <!-- Message for users who are not logged in -->
                <div class="alert alert-warning">
                    You are not logged in. Please <a href="login.html">log in</a>.
                </div>';
            }
        ?>
    </div>
</body>
</html>