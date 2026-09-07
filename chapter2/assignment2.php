


<?php

// Store the Googleplex information in PHP variables.
$heading = "The Googleplex is the corporate headquarters complex of Google and its parent company Alphabet Inc. It is located at:";
$street = "1600 Amphitheatre Parkway";
$city = "Mountain View";
$state = "CA";
$country = "United States";

?>

<!doctype html>

<!-- Bamdad Takmilian -->

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Bamdad Takmilian"; ?></title>
</head>

<body>
<header> <h1><?php echo "googleplex"; ?></h1> </header>
    <?php
    // Display the heading and address using the PHP variables.
    
    echo "$heading<br><br>\n";
    echo "$street<br>\n";
    echo "$city, $state, $country";
    ?>

</body>
</html>

