<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'] ?? '';
    echo $_POST['first_name'] ?? '';
    echo $_POST['last_name'] ?? '';
    echo $_POST['gender'] ?? '';
    echo $_POST['date_of_birth'] ?? '';
    echo $_POST['mobile'] ?? '';
    echo $_POST['email'] ?? '';
    echo $_POST['address'] ?? '';
    echo $_POST['postal_code'] ?? '';
    echo $_POST['username'] ?? '';
    echo $_POST['password'] ?? '';
    echo $_POST['confirm_password'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $date_of_birth = $_POST['date_of_birth'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $postal_code = $_POST['postal_code'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Here you can add code to validate and process the registration data
}
?>