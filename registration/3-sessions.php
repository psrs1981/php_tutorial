<?php

// Start or resume the session before sending any HTML.
if (!session_start()) {
    http_response_code(500);
    exit('Unable to start the session.');
}

$pageTitle = 'Registration';
$fields = ['first_name', 'last_name', 'gender', 'date_of_birth', 'mobile', 'email', 'address', 'postal_code', 'username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $registration = [];

    foreach ($fields as $field) {
        if (!isset($_POST[$field]) || !is_string($_POST[$field]) || trim($_POST[$field]) === '') {
            http_response_code(400);
            exit('Please provide a value for every registration field.');
        }

        $registration[$field] = trim($_POST[$field]);
    }

    if (!filter_var($registration['email'], FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        exit('Please provide a valid email address.');
    }

    $password = $_POST['password'] ?? null;
    $confirmPassword = $_POST['confirm_password'] ?? null;

    if (!is_string($password) || $password === '' || !is_string($confirmPassword) || $password !== $confirmPassword) {
        http_response_code(400);
        exit('Please provide matching passwords.');
    }

    // Store JSON on the server, deliberately excluding passwords.
    $_SESSION['registration_details'] = json_encode($registration, JSON_THROW_ON_ERROR);

    if (!session_write_close()) {
        http_response_code(500);
        exit('Unable to save the session.');
    }

    header('Location: 3-sessions.php', true, 303);
    exit;
}

$savedDetails = null;

if (isset($_SESSION['registration_details'])) {
    $savedDetails = json_decode($_SESSION['registration_details'], true, 512, JSON_THROW_ON_ERROR);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main class="container py-5">
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
            <p class="text-muted mt-3">Use dummy details for this exercise. Form details are stored as JSON in the server-side session, excluding passwords. The browser normally stores only the session ID cookie. This does not create an account.</p>
            <button type="submit" name="action" value="register" class="btn btn-primary">Register</button>
        </form>

        <h2>Details retrieved from the session</h2>
        <?php if ($savedDetails !== null): ?>
            <pre><?= htmlspecialchars(json_encode($savedDetails, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR), ENT_QUOTES, 'UTF-8') ?></pre>
        <?php else: ?>
            <p>No registration details are stored yet.</p>
        <?php endif; ?>
    </main>
</body>
</html>
