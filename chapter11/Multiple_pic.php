<?php
// Assignment 11: Photo Contest — GUIDED STUDENT VERSION (MULTIPLE UPLOADS)
// Receives contest.html, validates visitor information and uploaded images,
// saves approved images under safe names, and displays the results.

// STEP 1 — Only process submissions sent using POST.
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Location: contest.html');
    exit;
}

// STEP 2 — Retrieve form values and prepare variables.
$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));

$errors = [];               // Collect validation messages.
$uploadedFiles = [];        // Stores successfully saved filenames.
$uploadDirectory = __DIR__ . '/uploads/';
$maximumFileSize = 1048576; // 1 MiB, expressed in bytes.
$allowedMimeTypes = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
];

// STEP 3 — Reusable HTML-escaping function (Chapter 10).
function escapeHtml(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// STEP 4 — Validate the visitor's name and email address.
if ($name === '') {
    $errors[] = 'Please enter your name.';
}

// TODO 1 — Complete email validation following the name example above.
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $errors[] = 'Please enter a valid email address.';
}

// --- EXTRA CREDIT: Re-structure multi-file array into manageable items ---
$photosToProcess = [];
if (isset($_FILES['photos']) && is_array($_FILES['photos']['name'])) {
    foreach ($_FILES['photos']['name'] as $index => $fileName) {
        $photosToProcess[] = [
            'name'     => $_FILES['photos']['name'][$index] ?? '',
            'type'     => $_FILES['photos']['type'][$index] ?? '',
            'tmp_name' => $_FILES['photos']['tmp_name'][$index] ?? '',
            'error'    => $_FILES['photos']['error'][$index] ?? UPLOAD_ERR_NO_FILE,
            'size'     => $_FILES['photos']['size'][$index] ?? 0,
        ];
    }
}

if (empty($photosToProcess)) {
    $errors[] = 'Please select at least one photograph to upload.';
}

// Loop through each uploaded photo
foreach ($photosToProcess as $photo) {
    $uploadReady = false;
    $extension = '';

    // STEP 5 — Confirm uploaded file with no PHP upload errors.
    if (!is_array($photo)
        || !isset($photo['error'], $photo['size'], $photo['tmp_name'])
        || !is_int($photo['error'])
        || !is_int($photo['size'])
        || !is_string($photo['tmp_name'])) {
        $errors[] = 'Please select a valid photograph to upload.';
        continue;
    } elseif ($photo['error'] === UPLOAD_ERR_NO_FILE) {
        $errors[] = 'Please select a photograph to upload.';
        continue;
    } elseif ($photo['error'] === UPLOAD_ERR_FORM_SIZE || $photo['error'] === UPLOAD_ERR_INI_SIZE) {
        $errors[] = 'The photograph "' . escapeHtml($photo['name']) . '" exceeds the upload size limit.';
        continue;
    } elseif ($photo['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'The photograph could not be uploaded (error ' . $photo['error'] . ').';
        continue;
    } else {
        $uploadReady = true;
    }

    // STEP 6 — Check file size and inspect the actual MIME type with Fileinfo.
    if ($uploadReady) {
        if ($photo['size'] <= 0) {
            $errors[] = 'The selected photograph is empty.';
            continue;
        } elseif ($photo['size'] > $maximumFileSize) {
            $errors[] = 'The photograph must not exceed 1 MB (1,048,576 bytes).';
            continue;
        }

        if (!is_uploaded_file($photo['tmp_name'])) {
            $errors[] = 'The uploaded photograph could not be verified.';
        } else {
            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
            if ($fileInfo === false) {
                $errors[] = 'The server could not inspect the photograph.';
            } else {
                $mimeType = finfo_file($fileInfo, $photo['tmp_name']);
                finfo_close($fileInfo);

                if ($mimeType === false || !isset($allowedMimeTypes[$mimeType])) {
                    $errors[] = 'Only JPEG and PNG photographs are allowed.';
                } else {
                    // TODO 2 — Get the trusted extension from $allowedMimeTypes.
                    $extension = $allowedMimeTypes[$mimeType];
                }
            }
        }
    }

    // STEP 7 — Confirm directory permissions, assign a new name, and move the file.
    if ($uploadReady && empty($errors) && $extension !== '') {
        if (!is_dir($uploadDirectory)) {
            $errors[] = 'The uploads directory does not exist.';
        } elseif (!is_writable($uploadDirectory)) {
            $errors[] = 'The uploads directory is not writable.';
        } else {
            // TODO 3 — Create a new filename with random_bytes(16), bin2hex(), and $extension.
            $storedFilename = bin2hex(random_bytes(16)) . '.' . $extension;
            $destination = $uploadDirectory . $storedFilename;

            // TODO 4 — Replace false with a call to move_uploaded_file().
            if (move_uploaded_file($photo['tmp_name'], $destination)) {
                $uploadedFiles[] = $storedFilename; // Save successful filename to array
            } else {
                $errors[] = 'The photograph could not be saved. Please try again.';
            }
        }
    }
}

$uploaded = !empty($uploadedFiles) && empty($errors);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Contest Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="wrapper">
        <header>
            <h1>Photo Contest</h1>
        </header>
        <main>
            <h2>Submission Results</h2>

            <?php if (!empty($errors)): ?>
                <h3>Please correct the following:</h3>
                <ul class="error">
                    <?php foreach ($errors as $error): ?>
                        <li><?= escapeHtml($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php elseif ($uploaded): ?>
                <!-- STEP 8 — Display the confirmation and saved photographs. -->
                <p class="message">Thank you, <?= escapeHtml($name) ?>, for entering our contest!</p>
                <p>Your photo(s) were uploaded successfully.</p>
                <div class="photo-gallery">
                    <?php foreach ($uploadedFiles as $storedFile): ?>
                        <img class="photo-preview"
                             src="uploads/<?= escapeHtml($storedFile) ?>"
                             alt="Photograph submitted by <?= escapeHtml($name) ?>">
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="error">Your photographs have not been saved. Check the TODO sections and try again.</p>
            <?php endif; ?>

            <p><a class="back-link" href="contest.html">Return to the Photo Contest form</a></p>
        </main>
    </div>
</body>
</html>
