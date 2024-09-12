<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #e1e1e1;
        }
        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
            <form action="login-process.php" method="POST">
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text"><i class="fas fa-envelope"></i> Email</span>
                    </label>
                    <input type="email" name="email" placeholder="Your Email" class="input input-bordered w-full" required>
                </div>

                <div class="form-control mb-6">
                    <label class="label">
                        <span class="label-text"><i class="fas fa-lock"></i> Password</span>
                    </label>
                    <input type="password" name="password" placeholder="Your Password" class="input input-bordered w-full" required>
                </div>

                <div class="form-control mb-4">
                    <button type="submit" class="btn btn-primary w-full">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <p>Don't have an account? <a href="register-form.php" class="text-blue-500 hover:underline">Register here</a></p>
            </div>
        </div>
    </div>
</body>
</html>
