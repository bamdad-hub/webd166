<?php

// ----------------------------------------------------
// Chapter 10: Pizza Function Challenge
// Shared working starter for Team A and Team B
// This version intentionally uses no user-defined functions.
// ----------------------------------------------------


// Create an associative array of approved pizza toppings.
//
// The checkbox value is the key.
// The text displayed to the customer is the value.
$allowedToppings = [
    'extra_cheese' => 'Extra Cheese',
    'pepperoni' => 'Pepperoni',
    'sausage' => 'Sausage',
    'meatballs' => 'Meatballs',
    'tomato' => 'Tomato',
    'onion' => 'Onion',
    'olives' => 'Olives',
    'peppers' => 'Peppers',
    'mushroom' => 'Mushroom',
    'spinach' => 'Spinach',
    'garlic' => 'Garlic',
    'cilantro' => 'Cilantro'
];


// Initialize variables.
$name = '';
$phone = '';
$toppings = [];

$basePrice = 7.95;
$toppingPrice = 1.00;

$count = 0;
$cost = $basePrice;


// Retrieve the submitted form values.
// Use an empty string if a value is missing.
// Form inputs are normally strings, but requests can contain arrays.
$submittedName = $_POST['name'] ?? '';
$submittedPhone = $_POST['phone'] ?? '';
$name = is_string($submittedName) ? trim($submittedName) : '';
$phone = is_string($submittedPhone) ? trim($submittedPhone) : '';


// Retrieve the checkbox array.
// If no toppings were selected, use an empty array.
$submittedToppings = $_POST['topping'] ?? [];


// ====================================================
// TEAM B — TOPPING VALIDATION CHALLENGE
// This is working Chapter 7 logic. Your team will
// propose how to turn it into a reusable PHP function.
// Discuss: Which arrays should be parameters?
// What should the function return?
// Do not alter how approved toppings are determined.
// ====================================================
// define function to validate toppings
function validateToppings($submittedToppings, $allowedToppings)
{$toppings = [];
    // Make sure the submitted toppings are stored in an array.
    if (is_array($submittedToppings)) {

        // Loop through each submitted topping.
        foreach ($submittedToppings as $topping) {

            // Make sure the submitted value is a string
            // and exists in the approved toppings array.
            if (
                is_string($topping) &&
                isset($allowedToppings[$topping])
            ) {

                // Store the approved topping.
                $toppings[$topping] = $allowedToppings[$topping];
            }
        }
    }
    return $toppings;
}
// call the function
$toppings = validateToppings($submittedToppings, $allowedToppings);
// Count the approved toppings.
$count = count($toppings);


// ====================================================
// TEAM A — PIZZA PRICE CALCULATOR CHALLENGE
// This is working Chapter 7 logic. Your team will
// propose how to turn it into a reusable PHP function.
// Discuss: What value(s) should be parameters?
// What should the function return?
// Keep the original $7.95 + $1 per APPROVED topping.
// ====================================================

// Calculate the pizza cost.
// The pizza is $7.95 plus $1.00 for each topping.
$cost = $basePrice + ($count * $toppingPrice);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" rel="stylesheet">

    <title>Pizza Order Results</title>
</head>

<body>

    <main class="order-card">
        <section class="form-panel order-results">
            <header>
                <h1>Pizza Express</h1>
                <h2>Your Pizza Order</h2>
                <p class="price">One 12-inch cheese pizza: $7.95</p>
            </header>

            <section class="customer-info" aria-labelledby="customer-heading">
                <h3 id="customer-heading">Customer Information</h3>
                <p><strong>Name:</strong>
                    <?= htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                </p>
                <p><strong>Phone:</strong>
                    <?= htmlspecialchars($phone, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                </p>
            </section>

            <section class="pizza-summary" aria-labelledby="pizza-heading">
                <h3 id="pizza-heading">Your Pizza</h3>
                <?php if ($toppings === []): ?>
                    <p>You did not order any extra toppings, so you will receive our traditional cheese pizza.</p>
                <?php else: ?>
                    <p>You ordered <?= $count ?> topping(s):</p>
                    <ul class="selected-toppings">
                        <?php foreach ($toppings as $topping): ?>
                            <li><?= htmlspecialchars($topping, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </section>

            <p class="total">Total Cost: $<?= number_format($cost, 2) ?></p>
            <p class="return-link"><a href="pizza_order.html">Return to the Pizza Order Form</a></p>
        </section>
        <div class="pizza-panel" role="img" aria-label="Fresh pizza with assorted toppings"></div>
    </main>
</body>

</html>
