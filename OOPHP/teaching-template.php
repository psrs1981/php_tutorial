<?php
$sourceFile = basename($sourceFile);
$sourcePath = __DIR__ . DIRECTORY_SEPARATOR . $sourceFile;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($lessonTitle, ENT_QUOTES, "UTF-8") ?></title>
</head>
<body>
    <main>
        <p><a href="index.php">Back to OOPHP lessons</a></p>
        <h1><?= htmlspecialchars($lessonTitle, ENT_QUOTES, "UTF-8") ?></h1>
        <ul>
            <?php foreach ($lessonPoints as $point): ?>
                <li><?= htmlspecialchars($point, ENT_QUOTES, "UTF-8") ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>Run Example</h2>
        <p><a href="run-example.php?file=<?= rawurlencode($sourceFile) ?>" target="_blank" rel="noopener">Run this example in a new tab</a></p>

        <h2>Source Code</h2>
        <div><?php highlight_file($sourcePath); ?></div>
    </main>
</body>
</html>
