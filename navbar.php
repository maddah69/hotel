<?php

// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Function to check if the user is logged in
function isLoggedIn()
{
    return isset($_SESSION['user_id']); // Adjust based on your session management
}

// Usage example
if (isLoggedIn()) {
    // User is logged in, you can access session variables like $_SESSION['user_id']
} else {
    // User is not logged in, redirect to login page or show a message
    header("Location: login-form.php");
    exit(); // Ensure no further code is executed
}
?>

<nav class="navbar bg-blue-100 shadow-md">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Left Side -->
        <div class="flex items-center space-x-4">
            <!-- Search Form -->
            <form action="list.php" method="GET" class="flex items-center space-x-2">
                <input type="text" name="search" placeholder="Search..." class="input input-bordered input-sm" >
                <button type="search" class="btn btn-primary btn-sm" name="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <!-- Center - Tehran Time -->
        <div class="text-gray-800 font-semibold" id="tehran-time">Loading time...</div>

        <!-- Right Side -->
        <div class="flex items-center space-x-2">
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src="https://via.placeholder.com/40" alt="Avatar">
                    </div>
                </label>
                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-blue-100 rounded-box w-52">
                    <li><a href="insert-hotel.php"><i class="fas fa-hotel"></i> Add New Hotel</a></li>
                    <li><a href="edit-form.php"><i class="fas fa-user-edit"></i> Edit Profile</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    // JavaScript for Live Tehran Time
    function updateTime() {
        const options = {
            timeZone: 'Asia/Tehran',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        };
        const now = new Date().toLocaleTimeString('en-US', options);
        document.getElementById('tehran-time').textContent = `Current Tehran Time: ${now}`;
    }
    setInterval(updateTime, 1000);
    updateTime();
</script>

<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>
