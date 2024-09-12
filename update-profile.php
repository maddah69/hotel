<?php
session_start();
include 'conn.php';

// Initialize variables
$error_message = '';
$success_message = '';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login-form.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details for pre-filling the form
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT * FROM admins WHERE id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    } else {
        $error_message = 'User not found.';
    }
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $family = $conn->real_escape_string($_POST['family']);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Start building the update query
    $sql = "UPDATE admins SET name='$name', family='$family', mobile='$mobile', email='$email'";

    // Check if password is provided and hash it
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql .= ", password='$hashed_password'";
    }

    $sql .= " WHERE id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        $success_message = 'Profile updated successfully!';
    } else {
        $error_message = 'Error updating profile: ' . $conn->error;
    }
}

$conn->close();
header("location: login-form.php");
?>
