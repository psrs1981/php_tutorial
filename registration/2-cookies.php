<?php

$pageTitle = 'Registration';
$fields = ['first_name', 'last_name', 'gender', 'date_of_birth', 'mobile', 'email', 'address', 'postal_code', 'username'];

// Cookie headers must be sent before any HTML output.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $registration = [];

    foreach ($fields as $field) {
        // is_string() checks the submitted value's type; trim() removes whitespace at its ends.
        if (!isset($_POST[$field]) || !is_string($_POST[$field]) || trim($_POST[$field]) === '') {
            // http_response_code() sets the HTTP error status sent to the browser.
            http_response_code(400);
            exit('Please provide a value for every registration field.');
        }

        // trim() stores the value without extra whitespace at the beginning or end.
        $registration[$field] = trim($_POST[$field]);
    }

    // filter_var() uses FILTER_VALIDATE_EMAIL to check that the value has email-like formatting.
    if (!filter_var($registration['email'], FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        exit('Please provide a valid email address.');
    }

    $password = $_POST['password'] ?? null;
    $confirmPassword = $_POST['confirm_password'] ?? null;
    /**
     * <?php
filter_var($value, FILTER_VALIDATE_EMAIL); // Email format
filter_var($value, FILTER_VALIDATE_INT);   // Integer
filter_var($value, FILTER_VALIDATE_FLOAT); // Number with decimals
filter_var($value, FILTER_VALIDATE_BOOLEAN); // Boolean-like value
filter_var($value, FILTER_VALIDATE_URL);   // URL format
filter_var($value, FILTER_VALIDATE_IP);    // IP address
     */

    // is_string() confirms both submitted password values are strings before comparing them.
    if (!is_string($password) || $password === '' || !is_string($confirmPassword) || $password !== $confirmPassword) {
        http_response_code(400);
        exit('Please provide matching passwords.');
    }

    // Passwords are deliberately excluded from the cookie.
    // json_encode() converts the PHP array into a JSON string; JSON_THROW_ON_ERROR reports encoding failures.
    $json = json_encode($registration, JSON_THROW_ON_ERROR);

    // rawurlencode() prepares the JSON for a URL-encoded cookie; strlen() checks its encoded size.
    if (strlen(rawurlencode($json)) > 3000) {
        http_response_code(400);
        exit('The form details are too large for this cookie example. Please use shorter values.');
    }

    // setcookie() asks the browser to save this cookie; time() supplies the current time for its expiry.
    if (!setcookie('registration_details', $json, [
        'expires' => time() + 3600,
        'path' => '/',
        'httponly' => true,
    ])) {
        http_response_code(500);
        exit('Unable to send the registration cookie.');
    }

    // The browser sends the new cookie back on the redirected request.
    // header() sends the redirect response before the page's HTML is output.
    header('Location: 2-cookies.php', true, 303);
    exit;
}

$savedDetails = null;

if (isset($_COOKIE['registration_details'])) {
    // is_string() confirms the cookie value is text before decoding it.
    if (!is_string($_COOKIE['registration_details'])) {
        http_response_code(400);
        exit('The registration cookie is invalid. Clear it and try again.');
    }

    try {
        // json_decode() converts the cookie's JSON text back into a PHP array.
        $savedDetails = json_decode($_COOKIE['registration_details'], true, 512, JSON_THROW_ON_ERROR);
    } catch (JsonException $exception) {
        http_response_code(400);
        exit('The registration cookie contains invalid JSON. Clear it and try again.');
    }

    // is_array() checks the decoded value's type; count() checks it has the expected number of fields.
    if (!is_array($savedDetails) || count($savedDetails) !== count($fields)) {
        http_response_code(400);
        exit('The registration cookie has invalid fields. Clear it and try again.');
    }

    foreach ($fields as $field) {
        // is_string() confirms each expected cookie field contains text.
        if (!isset($savedDetails[$field]) || !is_string($savedDetails[$field])) {
            http_response_code(400);
            exit('The registration cookie has invalid values. Clear it and try again.');
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php // htmlspecialchars() escapes special characters so the title is safe to display in HTML. ?>
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main class="container py-5">
        <?php // htmlspecialchars() escapes special characters before displaying the title in HTML. ?>
        <h1><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></h1>
        <p>New user? <a href="#registration-form">Create an account</a></p>

        <form id="registration-form" method="post" class="border rounded p-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="first-name" class="form-label">First Name</label>
                    <input type="text" id="first-name" name="first_name" class="form-control" autocomplete="given-name" required>
                </div>
                <div class="col-md-4">
                    <label for="last-name" class="form-label">Last Name</label>
                    <input type="text" id="last-name" name="last_name" class="form-control" autocomplete="family-name" required>
                </div>
                <div class="col-md-4">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" name="gender" class="form-select" required>
                        <option value="">Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                        <option value="prefer_not_to_say">Prefer not to say</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="date-of-birth" class="form-label">Date of Birth</label>
                    <input type="date" id="date-of-birth" name="date_of_birth" class="form-control" autocomplete="bday" required>
                </div>
                <div class="col-md-4">
                    <label for="mobile" class="form-label">Mobile No.</label>
                    <input type="tel" id="mobile" name="mobile" class="form-control" autocomplete="tel" required>
                </div>
                <div class="col-md-4">
                    <label for="email" class="form-label">Email-Id</label>
                    <input type="email" id="email" name="email" class="form-control" autocomplete="email" required>
                </div>
                <div class="col-md-4">
                    <label for="address" class="form-label">Address</label>
                    <textarea id="address" name="address" class="form-control" rows="2" autocomplete="street-address" required></textarea>
                </div>
                <div class="col-md-4">
                    <label for="postal-code" class="form-label">Postal Code</label>
                    <input type="text" id="postal-code" name="postal_code" class="form-control" autocomplete="postal-code" required>
                </div>
            </div>
            <div class="row g-3 mt-0">
                <div class="col-md-4">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" autocomplete="username" required>
                </div>
                <div class="col-md-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" required>
                </div>
                <div class="col-md-4">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm_password" class="form-control" autocomplete="new-password" required>
                </div>
            </div>
            <p class="text-muted mt-3">Use dummy details only. This example stores form details as JSON in a cookie for one hour, excluding passwords. Cookies can be read or changed by the user; this does not create an account.</p>
            <button type="submit" name="action" value="register" class="btn btn-primary">Register</button>
        </form>

        <h2>Details retrieved from the cookie</h2>
        <?php if ($savedDetails !== null): ?>
            <?php // json_encode() formats the array as readable JSON; htmlspecialchars() escapes it for HTML output. ?>
            <pre><?= htmlspecialchars(json_encode($savedDetails, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR), ENT_QUOTES, 'UTF-8') ?></pre>
        <?php else: ?>
            <p>No registration details are stored yet.</p>
        <?php endif; ?>
    </main>
</body>
</html>
