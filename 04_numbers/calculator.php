<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// === SECTION 1: THE PHP PROCESSING BLOCK ===

// Retrieve values from the form.
$milesDriven = $_POST["miles_driven"];
$gallonsUsed = $_POST["gallons_used"];
$pricePerGallon = $_POST["price_gallon"];

// Calculate miles per gallon.
$mpg = $milesDriven / $gallonsUsed;

// Calculate the total cost of the trip.
$totalCost= $gallonsUsed * $pricePerGallon;
?>

<!doctype html>
<!-- Bamdad Takmilian -->
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Trip Calculator Results</title>
</head>
<body>
    <!-- === SECTION 2: THE HTML STRUCTURE === -->
    <h1> Trip Calculator Results</h1>
    <p>Miles Driven:
        <?php echo number_format($milesDriven); ?>
    </p>
    <p>Gallons Used:
        <?php echo number_format($gallonsUsed, 1); ?>
    </p>
    <p>Price Per Gallon:
        <?php echo "$" . number_format($pricePerGallon, 2); ?>
    </p>
    <p>Miles Per Gallon:
        <?php echo number_format($mpg, 2); ?>
    </p>
    <p>Total Cost of The Trip:
        <?php echo "$" . number_format($totalCost, 2); ?>

    </p>
</body>
</html>
