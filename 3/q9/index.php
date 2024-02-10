<!DOCTYPE html>
<html>
<head>
    <title>Random Page</title>
    <style>
        /* CSS for styling the page */
        body {
            font-family: 'Georgia', serif; /* font */
            text-align: center;
            margin: 2em; 
        }
        .date {
            position: fixed;
            bottom: 1em; 
            width: 100%;
            text-align: center;
            font-size: 1.2em; /* font size */
        }
        .content {
            margin-top: 4em; 
            font-size: 1.5em; 
        }
        img {
            max-width: 100%; /* Ensure images are not larger than the screen width */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>
<body>
    <?php
    // Randomly choose between two formats (0 or 1)
    $format = rand(0, 1);

    // Array of image paths
    $images = ['image1.jpeg', 'image2.jpeg', 'image3.jpeg', 'image4.jpeg'];
    // Array of quotes
    $quotes = [
        "Discipline = Freedom",
        "Better late than never",
        "Success is the sum of small efforts, repeated day-in and day-out. ---Robert Collier",
        "Do one thing every day that scares you. -Eleanor Roosevelt"
    ];

    // Div for the main content
    echo "<div class='content'>";
    if ($format == 0) {
        // If format is 0, choose and display a random image
        $selectedImageIndex = rand(0, 3); // Get a random index for the image
        $selectedImage = $images[$selectedImageIndex];
        echo "<img src='$selectedImage' alt='Random Image'>";
    } else {
        // If format is 1, choose and display a random quote
        $selectedQuoteIndex = rand(0, 3); // Get a random index for the quote
        $selectedQuote = $quotes[$selectedQuoteIndex];
        echo "<p>$selectedQuote</p>";
    }
    echo "</div>";

    // Display the current date, day, and time at the bottom of the page
    date_default_timezone_set("America/New_York"); // set time zone
    echo "<div class='date'>" . date("Y-m-d l H:i:s") . "</div>";
    ?>
</body>
</html>
