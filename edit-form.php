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

    // Check if password is provided and hash it
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE admins SET name='$name', family='$family', mobile='$mobile', email='$email', password='$hashed_password' WHERE id='$user_id'";
    } else {
        $sql = "UPDATE admins SET name='$name', family='$family', mobile='$mobile', email='$email' WHERE id='$user_id'";
    }

    if ($conn->query($sql) === TRUE) {
        $success_message = 'Profile updated successfully!';
    } else {
        $error_message = 'Error updating profile: ' . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        .form-container {
            max-width: 500px;
            margin: 2rem auto;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="form-container p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Edit Profile</h2>

        <?php if ($error_message): ?>
            <p class="text-red-500 mb-4 text-center"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <?php if ($success_message): ?>
            <p class="text-green-500 mb-4 text-center"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <form action="update-profile.php" method="POST">
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text"><i class="fas fa-user"></i> Name</span>
                </label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" class="input input-bordered w-full" required>
            </div>

            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text"><i class="fas fa-user-tag"></i> Family</span>
                </label>
                <input type="text" name="family" value="<?php echo htmlspecialchars($user['family']); ?>" class="input input-bordered w-full" required>
            </div>

            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text"><i class="fas fa-phone"></i> Mobile</span>
                </label>
                <input type="text" name="mobile" value="<?php echo htmlspecialchars($user['mobile']); ?>" class="input input-bordered w-full" required>
            </div>

            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text"><i class="fas fa-envelope"></i> Email</span>
                </label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="input input-bordered w-full" required>
            </div>


            <div class="form-control mb-6">
                <label class="label">
                    <span class="label-text"><i class="fas fa-lock"></i> New Password (optional)</span>
                </label>
                <input type="password" name="password" placeholder="New Password" class="input input-bordered w-full">
            </div>

            <div class="form-control">
                <button type="submit" class="btn btn-primary w-full">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</body>
</html>
