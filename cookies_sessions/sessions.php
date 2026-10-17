<?php

// Start or resume the session before sending any HTML to the browser.
if (!session_start()) {
    http_response_code(500);
    exit('Unable to start the session.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'store') {
        $_SESSION['tutorial_username'] = 'Ravi';
    } elseif ($action === 'delete') {
        unset($_SESSION['tutorial_username']);
    } elseif ($action === 'destroy') {
        $_SESSION = [];

        if (!session_destroy()) {
            http_response_code(500);
            exit('Unable to destroy the session.');
        }
    } else {
        http_response_code(400);
        exit('Unknown session action.');
    }

    header('Location: sessions.php', true, 303);
    exit;
}

$username = $_SESSION['tutorial_username'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Sessions</title>
</head>
<body>
    <h1>PHP Sessions: Store, Retrieve, and Delete</h1>
    <p>Session values are stored on the server. The browser normally holds only a session ID cookie.</p>
    <h2>Current value</h2>
    <?php if (is_string($username)): ?>
        <p>Username: <?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?></p>
    <?php else: ?>
        <p>No username is stored in the session.</p>
    <?php endif; ?>
    <form method="post">
        <button type="submit" name="action" value="store">Store Ravi in the session</button>
        <button type="submit" name="action" value="delete">Delete the username</button>
        <button type="submit" name="action" value="destroy">Destroy the session</button>
    </form>
    <h2>How it works</h2>
    <ul>
        <li>Start or resume: <code>session_start()</code> on every page that uses the session.</li>
        <li>Store: <code>$_SESSION['tutorial_username'] = 'Ravi';</code>.</li>
        <li>Retrieve: <code>$_SESSION['tutorial_username'] ?? null</code>.</li>
        <li>Delete one value: <code>unset($_SESSION['tutorial_username']);</code>.</li>
        <li>Delete all data: clear <code>$_SESSION</code>, then call <code>session_destroy()</code>.</li>
        <li>Destroying session data does not delete the session ID cookie. The redirected page starts a new empty session.</li>
        <li>Refresh the page after storing a value to see that it persists between requests.</li>
    </ul>
    <p><a href="cookies.php">Try the cookie example</a></p>
</body>
</html>
