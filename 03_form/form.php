
<?php

// Retrieve the values submitted from the form.

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$heard = $_POST['heard'];
$comments = $_POST['comments'];



?>

<!DOCTYPE html>
<!-- Bamdad Takmilian -->

<html lang="en">


<head>
    <meta charset="utf-8">
    <title>Account Sign Up Results</title>
    <link rel="stylesheet" href="form.css">
</head>

<body>

    <header>
        <h1>Account Sign Up Results</h1>
    </header>

    <main>

        <p><strong>Name:</strong> <?php echo $name; ?></p>

        <p><strong>E-Mail:</strong> <?php echo $email; ?></p>

        <p><strong>Phone Number:</strong> <?php echo $phone; ?></p>

        <p><strong>How did you hear about us?</strong> <?php echo $heard; ?></p>

        <p><strong>Comments:</strong> <?php echo $comments; ?></p>

    </main>

</body>
</html>