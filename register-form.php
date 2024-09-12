<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        .error-message {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <form id="registerForm" class="p-8 bg-white rounded-lg shadow-md w-full max-w-4xl space-y-4" method="POST" action="register.php">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Register</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Name -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text"><i class="fas fa-user"></i> Name</span>
                    </label>
                    <input type="text" name="name" placeholder="first name" class="input input-bordered w-full" required>
                </div>

                <!-- Family -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text"><i class="fas fa-user-friends"></i> Family</span>
                    </label>
                    <input type="text" name="family" placeholder="last name" class="input input-bordered w-full" required>
                </div>

                <!-- Mobile -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text"><i class="fas fa-phone"></i> Mobile</span>
                    </label>
                    <input type="text" name="mobile" placeholder="09XXxxxxxxx" class="input input-bordered w-full" required>
                </div>

                <!-- Email -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text"><i class="fas fa-envelope"></i> Email</span>
                    </label>
                    <input type="email" name="email" placeholder="example@example.com" class="input input-bordered w-full" required>
                </div>

                <!-- Password -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text"><i class="fas fa-lock"></i> Password</span>
                    </label>
                    <input type="password" name="password" placeholder="********" class="input input-bordered w-full" required>
                </div>
                
                <!-- Confirm Password -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text"><i class="fas fa-lock"></i> Confirm Password</span>
                    </label>
                    <input type="password" name="confirmpassword" placeholder="********" class="input input-bordered w-full" required>
                    <p id="error-message" class="error-message"></p>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="form-control mt-6">
                <button type="submit" class="btn btn-primary w-full">
                    <i class="fas fa-user-plus"></i> Register
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirmPassword').value;
            var errorMessage = document.getElementById('error-message');

            if (password !== confirmPassword) {
                event.preventDefault(); // Prevent form submission
                errorMessage.textContent = 'Passwords do not match.';
            } else {
                errorMessage.textContent = '';
            }
        });
    </script>
</body>
</html>
