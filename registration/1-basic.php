<?php

$pageTitle = 'Registration';

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

        <form id="registration-form" method="post" class="border rounded p-4" action="submit_registration.php">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="first-name" class="form-label">First Name</label>
                    <input type="text" id="first-name" name="first_name" class="form-control" autocomplete="given-name" required>
                    <?php echo "sample";?>
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
            <p class="text-muted mt-3">This step demonstrates the form layout only. Saving will be added in a later step.</p>
            <button type="submit" name="action" value="register" class="btn btn-primary" >Register</button>
        </form>
    </main>
</body>
</html>
