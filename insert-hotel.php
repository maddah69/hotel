<?php
// Include your database connection
include('conn.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $star = $_POST['star'];

    // Prepare the SQL query to insert data into the 'shiraz' table
    $query = "INSERT INTO shiraz (name, address, city, phone, email, star) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $name, $address, $city, $phone, $email, $star);

    // Execute the query and check if the insertion was successful
    if ($stmt->execute()) {
        echo "<p class='text-green-500 text-center'>Hotel added successfully!</p>";
    } else {
        echo "<p class='text-red-500 text-center'>Error: " . $stmt->error . "</p>";
    }
}
?>

<!-- Include DaisyUI, Tailwind, and FontAwesome -->
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<!-- Custom Styling to Center the Form and Set Fullscreen Background -->
<style>
    html, body {
        height: 100%;
        margin: 0;
        background-color: #f3f4f6;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .form-container {
        width: 500px;
        background: white;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
</style>

<!-- Form Structure -->
<div class="form-container">
    <h1 class="text-2xl font-bold mb-6 text-center">Add New Hotel</h1>
    <form action="list.php?insert=done" method="POST" class="form-control w-full max-w-lg">
        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text">
                    <i class="fas fa-hotel mr-2"></i> Name
                </span>
            </label>
            <input type="text" name="name" class="input input-bordered w-full" required>
        </div>

        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text">
                    <i class="fas fa-map-marker-alt mr-2"></i> Address
                </span>
            </label>
            <input type="text" name="address" class="input input-bordered w-full" required>
        </div>

        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text">
                    <i class="fas fa-city mr-2"></i> City
                </span>
            </label>
            <input type="text" name="city" class="input input-bordered w-full" required>
        </div>

        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text">
                    <i class="fas fa-phone mr-2"></i> Phone Number
                </span>
            </label>
            <input type="text" name="phone" class="input input-bordered w-full" required>
        </div>

        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text">
                    <i class="fas fa-envelope mr-2"></i> Email
                </span>
            </label>
            <input type="email" name="email" class="input input-bordered w-full" required>
        </div>

        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text">
                    <i class="fas fa-star mr-2"></i> Star
                </span>
            </label>
            <input type="number" name="star" class="input input-bordered w-full" min="1" max="5" required>
        </div>

        <div class="form-control mt-6">
            <button type="submit" class="btn btn-primary w-full">
                <i class="fas fa-save mr-2"></i> Add Hotel
            </button>
        </div>
    </form>
</div>
