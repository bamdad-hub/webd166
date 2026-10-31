<?php
// Chapter 9: PHP Sessions and a Multi-Page Form
// Name: Bamdad Takmilian


session_start();

$valid_income = [
    'under $20,000',
    '$20,000 to $39,000',
    '$40,000 to $59,000',
    '$60,000 to $80,000',
    'over $80,000'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $income = ($_POST['income'] ?? '');

    if (in_array($income, $valid_income, true)) {

        $_SESSION['income'] = $income;

        header('Location: survey_result.php');
        exit;
    }
}

if (!isset($_SESSION['age'], $_SESSION['eduation'], $_SESSION['income'])) {
    header('Location: survey.php');
    exit;
}

$age = $_SESSION['age'] ?? '';
$education = $_SESSION['education'] ?? '';
$income = $_SESSION['income'] ?? '';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anonymous Survey Results</title>
    <link rel="stylesheet" href="survey.css">
</head>

<body>
    <div class="wrapper">
        <header>
            <h1>Thank You for Taking Our Anonymous Survey</h1>

            <img class="survey-image"
                src="https://thewisconsinvegetablegardener.files.wordpress.com/2019/05/adm_survey_660x320.png?w=705"
                alt="Survey clipboard">
        </header>

        <main>
            <h2>Your Responses</h2>
            <ul class="results">
                <li><strong>Age:</strong> <?php echo htmlspecialchars($age, ENT_QUOTES, 'UTF-8'); ?></li>
                <li><strong>Education:</strong> <?php echo htmlspecialchars($education, ENT_QUOTES, 'UTF-8'); ?></li>
                <li><strong>Income:</strong> <?php echo htmlspecialchars($income, ENT_QUOTES, 'UTF-8'); ?></li>
            </ul>
            <p class="actions"><a class="button-link" href="survey.php">Take the Survey Again</a></p>
        </main>
    </div>
</body>

</html>
