<?php

// Cookies must be set or deleted before sending any HTML to the browser.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $success = true;

    if ($action === 'store') {
        $success = setcookie('tutorial_username', 'Ravi', [
            'expires' => time() + 3600,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    } elseif ($action === 'delete') {
        $success = setcookie('tutorial_username', '', [
            'expires' => time() - 3600,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    } else {
        http_response_code(400);
        exit('Unknown cookie action.');
    }

    if (!$success) {
        http_response_code(500);
        exit('Unable to send the cookie to the browser.');
    }

    // The browser sends the updated cookie on the next request.
    header('Location: cookies.php', true, 303);
    exit;
}

$username = $_COOKIE['tutorial_username'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Cookies</title>
</head>
<body>
    <h1>PHP Cookies: Store, Retrieve, and Delete</h1>
    <p>A cookie stores a small value in the browser. This example expires after one hour.</p>
    <h2>Current value</h2>
    <?php if (is_string($username)): ?>
        <p>Username: <?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?></p>
    <?php else: ?>
        <p>No username cookie is stored.</p>
    <?php endif; ?>
    <form method="post">
        <button type="submit" name="action" value="store">Store Ravi in a cookie</button>
        <button type="submit" name="action" value="delete">Delete the cookie</button>
    </form>
    <h2>How it works</h2>
    <ul>
        <li>Store: <code>setcookie('tutorial_username', 'Ravi', ...)</code>.</li>
        <li>Retrieve: <code>$_COOKIE['tutorial_username'] ?? null</code>.</li>
        <li>Delete: set the same cookie name and path with an expiry time in the past.</li>
        <li>The redirect loads a new request so the updated cookie can be retrieved.</li>
        <li>Cookies can be changed by the user. Do not store passwords or trust cookie values.</li>
    </ul>
    <p><a href="sessions.php">Try the session example</a></p>
</body>
</html>
