<?php

// Helper functions for database access, form handling, and table output.
function handleSubmit(mysqli $conn): string
{
    // Collect submitted fields, normalize ordinary text values, and check them before saving.
    $registration = readForm();

    foreach ($registration as $field => $value) {
        if (is_string($value) && $field !== 'password' && $field !== 'confirm_password') {
            $registration[$field] = trim($value);
        }
    }

    // Stop before writing to the database if any field fails server-side validation.
    $error = validateForm($registration);

    if ($error !== '') {
        http_response_code(400);
        return $error;
    }

    // Save the validated registration and close this request's database connection.
    saveRegistration($conn, $registration);
    $conn->close();

    // Redirect so refreshing the page does not repeat the INSERT.
    header('Location: 4-mysqli.php', true, 303);
    exit;
}

function connectDatabase(): mysqli
{
    //reading from the .env file located in the parent directory
    // __DIR__ gives the directory of the current file, so dirname(__DIR__) gives the parent directory.
    //dirname(__DIR__) gives the parent directory of the current file.
    // DIRECTORY_SEPARATOR is a predefined constant in PHP that provides the correct directory separator for the current platform.
    $envFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env';
    //
    $settings = parse_ini_file($envFile, false, INI_SCANNER_RAW);

    if ($settings === false) {
        http_response_code(500);
        exit('Unable to read the database settings from .env.');
    }

    foreach (['MYSQL_SERVERNAME', 'MYSQL_PORT', 'MYSQL_USERNAME', 'MYSQL_PASSWORD', 'MYSQL_DBNAME'] as $key) {
        // Require every setting and ensure it has the string value expected from the .env file.
        if (!isset($settings[$key]) || !is_string($settings[$key])) {
            http_response_code(500);
            exit('Missing or invalid database setting: ' . $key);
        }
    }

    // Connect using the loaded settings; cast the port from its .env string to an integer.
    $conn = new mysqli(
        $settings['MYSQL_SERVERNAME'],
        $settings['MYSQL_USERNAME'],
        $settings['MYSQL_PASSWORD'],
        $settings['MYSQL_DBNAME'],
        (int) $settings['MYSQL_PORT']
    );
    // Use UTF-8 support for database text, including characters outside basic ASCII.
    $conn->set_charset('utf8mb4');
    return $conn;
}

function readForm(): array
{
    // Return every expected form field, using an empty string when a field was not submitted.
    return [
        'first_name' => $_POST['first_name'] ?? '',
        'last_name' => $_POST['last_name'] ?? '',
        'gender' => $_POST['gender'] ?? '',
        'date_of_birth' => $_POST['date_of_birth'] ?? '',
        'mobile' => $_POST['mobile'] ?? '',
        'email' => $_POST['email'] ?? '',
        'address' => $_POST['address'] ?? '',
        'postal_code' => $_POST['postal_code'] ?? '',
        'username' => $_POST['username'] ?? '',
        'password' => $_POST['password'] ?? '',
        'confirm_password' => $_POST['confirm_password'] ?? '',
    ];
}

// Return an error message, or an empty string when the form is valid.
function validateForm(array $registration): string
{
    // Reject missing values or non-string input before applying field-specific checks.
    foreach ($registration as $field => $value) {
        if (!is_string($value) || trim($value) === '') {
            // Convert an underscored field name into a readable label for the validation message.
            return 'Please provide a value for ' . str_replace('_', ' ', $field) . '.';
        }
    }

    // Parse the date in the browser's YYYY-MM-DD format; "!" resets unspecified time parts to avoid inherited values.
    $birthDate = DateTimeImmutable::createFromFormat('!Y-m-d', $registration['date_of_birth']);
    $password = $registration['password'];

    // Strict comparison accepts only one of the exact values offered by the gender select menu.
    if (!in_array($registration['gender'], ['male', 'female', 'other', 'prefer_not_to_say'], true)) {
        return 'Please select a valid gender.';
    }
    // Check parsing succeeded, round-trip the date to reject impossible dates, and disallow dates after today.
    if (!$birthDate || $birthDate->format('Y-m-d') !== $registration['date_of_birth'] || $birthDate > new DateTimeImmutable('today')) {
        return 'Please provide a valid date of birth that is not in the future.';
    }
    // ^ and $ require the whole value to match; D makes $ match only at the end, allowing exactly 10 digits.
    if (!preg_match('/^[0-9]{10}$/D', $registration['mobile'])) {
        return 'Mobile number must contain exactly 10 digits.';
    }
    // Validate the email's format on the server; this does not verify that the address exists.
    if (!filter_var($registration['email'], FILTER_VALIDATE_EMAIL)) {
        return 'Please provide a valid email address.';
    }
    // The address column is a TEXT field, whose maximum capacity is 65,535 bytes.
    if (strlen($registration['address']) > 65535) {
        return 'The address is too long.';
    }
    // Compare both submitted password strings so a typing mistake cannot silently set the wrong password.
    if ($password !== $registration['confirm_password']) {
        return 'Password and Confirm Password must match.';
    }
    // Enforce bcrypt's 72-byte input limit and reject null bytes, which password hashing does not support.
    if (strlen($password) > 72 || strpos($password, "\0") !== false) {
        return 'Password must be at most 72 bytes and cannot contain null characters.';
    }

    return '';
}

function saveRegistration(mysqli $conn, array $registration): void
{
    // Store only a one-way password hash, never the original password.
    $passwordHash = password_hash($registration['password'], PASSWORD_DEFAULT);
    // Prepare a parameterized INSERT so user-provided values are treated as data, not SQL.
    $stmt = $conn->prepare(
        'INSERT INTO registrations
        (first_name, last_name, gender, date_of_birth, mobile, email, address, postal_code, username, password_hash)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
    );
    // Associate each form value with its placeholder in the prepared INSERT.
    // Each "s" in the type string tells MySQLi that the corresponding value is a string.
    $stmt->bind_param(
        'ssssssssss',
        $registration['first_name'],
        $registration['last_name'],
        $registration['gender'],
        $registration['date_of_birth'],
        $registration['mobile'],
        $registration['email'],
        $registration['address'],
        $registration['postal_code'],
        $registration['username'],
        $passwordHash
    );
    // Run the INSERT and release the prepared statement.
    $stmt->execute();
    $stmt->close();
}

function handleShowRegistrations(mysqli $conn): array
{
    // Select only the details intended for display; password hashes are deliberately excluded.
    $result = $conn->query(
        'SELECT id, first_name, last_name, gender, date_of_birth, mobile, email, address, postal_code, username, created_at
        FROM registrations ORDER BY id DESC'
    );
    // MYSQLI_ASSOC uses column names as array keys; free the result resource once all rows are in PHP memory.
    $registrations = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
    return $registrations;
}

function renderTable(array $registrations): void
{
    ?>
    <h2 class="mt-4">Saved registrations</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Mobile No.</th>
                    <th scope="col">Email-Id</th>
                    <th scope="col">Address</th>
                    <th scope="col">Postal Code</th>
                    <th scope="col">Username</th>
                    <th scope="col">Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($registrations === []): ?>
                    <?php // Show a clear empty state rather than rendering an empty table body. ?>
                    <tr><td colspan="11">No registrations saved yet.</td></tr>
                <?php else: ?>
                    <?php foreach ($registrations as $row): ?>
                        <tr>
                            <?php foreach ($row as $value): ?>
                                <?php // Escape database values before placing them in HTML to prevent HTML injection. ?>
                                <?php // Convert values such as numeric IDs to strings because htmlspecialchars() escapes text. ?>
                                <td><?= htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8') ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// Page setup and request handling.
$pageTitle = 'Registration';

// Make MySQLi throw exceptions for database errors so the catch block below can handle them.
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$error = '';
$registrations = [];
// Read the requested action from the URL to decide whether saved rows should be displayed.
$showTable = ($_GET['action'] ?? '') === 'show';

try {
    // Open the database connection before handling form submissions or database reads.
    $conn = connectDatabase();

    // Process submitted registration details before rendering the page.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $error = handleSubmit($conn);
    }

    // Load saved registrations only when the user requests the table.
    if ($showTable) {
        $registrations = handleShowRegistrations($conn);
    }
    // Close the connection after all database work for this request is complete.
    $conn->close();
} catch (mysqli_sql_exception $exception) {
    // Log technical details for the developer without exposing them in the browser.
    error_log('Registration database error: ' . $exception->getMessage());
    // MySQL error 1062 indicates a duplicate value in a unique column such as username or email.
    if ($exception->getCode() === 1062) {
        http_response_code(409);
        exit('That username or email address is already registered. Go back to the form and use different details.');
    }

    // Report other database failures with a generic message rather than exposing server details.
    http_response_code(500);
    exit('Unable to save or read registrations. Check the MySQL connection, run query.txt in the student database if the table is missing, and check the PHP error log.');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main class="container py-5">
        <h1><?= $pageTitle ?></h1>
        <p>New user? <a href="#registration-form">Create an account</a></p>
        <?php // Show validation feedback returned while processing the submitted form. ?>
        <?php if ($error !== ''): ?>
            <p role="alert"><?= $error ?></p>
        <?php endif; ?>

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
            <p class="text-muted mt-3">This local tutorial saves registrations in MySQL. Click Show Registrations to view them. Use dummy details only. Passwords are hashed and never displayed; Confirm Password is not saved.</p>
            <button type="submit" name="action" value="register" class="btn btn-primary">Register</button>
        </form>

        <form method="get" action="4-mysqli.php" class="mt-4">
            <button type="submit" name="action" value="show" class="btn btn-secondary">Show Registrations</button>
        </form>

        <?php // Render saved database rows only when the Show Registrations action was requested. ?>
        <?php if ($showTable): ?>
            <?php renderTable($registrations); ?>
        <?php endif; ?>
    </main>
</body>
</html>
