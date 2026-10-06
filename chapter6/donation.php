<?php
// Display errors during development
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Create flag variable
$okay = true;

// Start the PHP Message Variable with the initial back link
$msg = "<p>Please <a href=\"donation2.html\">GO BACK</a> and fill in the following errors:</p>\n";

// Assign default values from the form
$fname       = trim($_POST['fname'] ?? '');
$lname       = trim($_POST['lname'] ?? '');
$email       = trim($_POST['email'] ?? '');
$amount_raw  = trim($_POST['amount'] ?? '');

// Validate First Name
if (empty($fname)) {
    $msg .= "<p>Please enter your first name.</p>\n";
    $okay = false;
}

// Validate Last Name
if (empty($lname)) {
    $msg .= "<p>Please enter your last name.</p>\n";
    $okay = false;
}

// Validate Email Address
if (empty($email)) {
    $msg .= "<p>Please enter your email address.</p>\n";
    $okay = false;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $msg .= "<p>Please enter a valid email address.</p>\n";
    $okay = false;
}

// Validate Donation Amount
if ($amount_raw === '') {
    $msg .= "<p>Amount is missing. Please enter a valid amount.</p>\n";
    $okay = false;
} elseif (!is_numeric($amount_raw)) {
    $msg .= "<p>Amount is not a number.</p>\n";
    $okay = false;
} elseif ($amount_raw <= 0) {
    $msg .= "<p>Amount must be greater than zero.</p>\n";
    $okay = false;
}

// Process data if all validations pass
if ($okay) {
    // 1. Format the Donation Amount
    $formatted_amount = number_format((float)$amount_raw, 2);

    // 2. Create the Confirmation Number
    $length       = strlen($lname);
    $last_initial = strtoupper(substr($lname, 0, 1));
    $rand         = random_int(1000, 9999);
    $conf         = $length . $last_initial . $rand;

    // 3. Subscription Message using Switch Statement
    if (isset($_POST['subscription'])) {
        $subscription_status = 'no_subscription';
    } else {
        $subscription_status = 'subscription';
    }

    switch ($subscription_status) {
        case 'no_subscription':
            $sub_msg = "You have chosen not to receive a free one-year subscription to our e-magazine.";
            break;
        case 'subscription':
            $sub_msg = "You will receive a free one-year subscription to our e-magazine.";
            break;
    }

    // 4. Create the Donation Level using if, elseif, else
    if ($amount_raw >= 100) {
        $level = "Gold Supporter";
    } elseif ($amount_raw >= 50) {
        $level = "Silver Supporter";
    } elseif ($amount_raw >= 25) {
        $level = "Bronze Supporter";
    } else {
        $level = "Friend of the Animals";
    }

    // 5. Create the Repeated Thank-You Message using a for loop
    $repeated_thanks = "";
    for ($i = 1; $i <= 3; $i++) {
        $repeated_thanks .= "Thank you! ";
    }
    $repeated_thanks = trim($repeated_thanks);

    // 6. Escape User-Entered Values
    $safe_fname = htmlspecialchars($fname, ENT_QUOTES, 'UTF-8');
    $safe_lname = htmlspecialchars($lname, ENT_QUOTES, 'UTF-8');
    $safe_email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

    // 7. Build the Success Message (Use '=' for the first line to replace error header)
    $msg  = "<p>Thank you $safe_fname $safe_lname for your donation of \$$formatted_amount.</p>\n";
    $msg .= "<p>Your confirmation number is $conf. We will email your receipt to $safe_email.</p>\n";
    $msg .= "<p>$sub_msg</p>\n";
    $msg .= "<p>Your donation level is $level.</p>\n";
    $msg .= "<p>$repeated_thanks</p>\n";
}
?>
<!DOCTYPE html>
<!-- Student Name: Bamdad Takmilian -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Donation Confirmation</title>

    <style>
        body {
            font-family: arial;
            font-size: 100%;
        }

        #outer {
            width: 960px;
            margin: 50px auto;
            padding: 10px;
            border: 1px solid #a8a8a8;
            box-shadow: 0px 0px 20px #a8a8a8;
            background-color: aliceblue;
        }

        h1,
        h2 {
            font-size: 1.5em;
            color: navy;
            text-align: center;
        }

        .info {
            text-align: left;
        }

        input {
            display: block;
            margin-bottom: 25px;
        }

        input[type=submit] {
            margin-top: 25px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Humane Society Donations</h1>
        <h2>Help the Animals</h2>
    </header>

    <section id="outer">
        <h1 class="info">Your Contribution</h1>
        <?php echo $msg; ?>
    </section>
</body>

</html>
