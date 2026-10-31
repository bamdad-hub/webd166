<?php
// Chapter 9: PHP Sessions and a Multi-Page Form
// Name:Bamdad Takmilian


session_start();

$valid_ages = ['under 18', '18 - 29', '30 - 49', '50 - 65', 'over 65'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $age = $_POST['age'] ?? '';

    if (in_array($age, $valid_ages, true)) {

        $_SESSION['age'] = $age;

        header('Location: survey2.php');
        exit;
    }
}


if (!isset($_SESSION['age'])) {
    header('Location: survey.php');
    exit;
}
?>
<!doctype html>
<!-- Name: Bamdad Takmilian -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anonymous Survey - Page 2</title>
    <link rel="stylesheet" href="survey.css">
</head>

<body>
    <div class="wrapper">

        <header>
            <h1>Anonymous Survey - Page 2</h1>

            <img class="survey-image"
                src="https://thewisconsinvegetablegardener.files.wordpress.com/2019/05/adm_survey_660x320.png?w=705"
                alt="Survey clipboard">
        </header>

        <main>
            <form action="survey3.php" method="post">

                <fieldset>
                    <legend>What is your highest level of education?</legend>

                    <div class="choice">
                        <input type="radio" id="hs" name="education" value="High School" required>
                        <label for="hs">High School</label>
                    </div>

                    <div class="choice">
                        <input type="radio" id="associate" name="education" value="Associate Degree">
                        <label for="associate">Associate Degree</label>
                    </div>

                    <div class="choice">
                        <input type="radio" id="bachelors" name="education" value="Bachelor's Degree">
                        <label for="bachelors">Bachelor's Degree</label>
                    </div>

                    <div class="choice">
                        <input type="radio" id="masters" name="education" value="Master's Degree">
                        <label for="masters">Master's Degree</label>
                    </div>

                    <div class="choice">
                        <input type="radio" id="doctoral" name="education" value="Doctoral Degree">
                        <label for="doctoral">Doctoral Degree</label>
                    </div>

                </fieldset>

                <button type="submit">Next &gt;&gt;</button>

            </form>
        </main>

    </div>
</body>

</html>