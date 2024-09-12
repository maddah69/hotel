<?php
// Include your database connection
include('conn.php');

// Get the hotel ID from the query string
$hotel_id = isset($_GET['id']) ? $_GET['id'] : null;

// Check if the hotel ID is present
if ($hotel_id) {
    // Query to fetch the hotel details from the 'shiraz' table
    $query = "SELECT * FROM shiraz WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $hotel_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if hotel data exists
    if ($result->num_rows > 0) {
        // Fetch the hotel data
        $hotel = $result->fetch_assoc();

        // Assign values to variables
        $name = $hotel['name'];
        $address = $hotel['address'];
        $city = $hotel['city'];
        $phone = $hotel['phone'];
        $email = $hotel['email'];
        $star = $hotel['star'];
    } else {
        echo "Hotel not found.";
        exit();
    }
} else {
    echo "Invalid hotel ID.";
    exit();
}
?>

<!-- Include DaisyUI, Tailwind, and FontAwesome -->
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<!-- Custom Styling to Center the Form -->
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f3f4f6;
    }
    .form-container {
        width: 500px;
        margin: auto;
        background: white;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
</style>

<!-- Form Structure -->
<div class="form-container">
    <form action="update-hotel.php" method="POST" class="form-control w-full max-w-lg">
        <input type="hidden" name="id" value="<?php echo $hotel_id; ?>">

        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text">
                    <i class="fas fa-hotel mr-2"></i> Name
                </span>
            </label>
            <input type="text" name="name" value="<?php echo $name; ?>" class="input input-bordered w-full" required>
        </div>

        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text">
                    <i class="fas fa-map-marker-alt mr-2"></i> Address
                </span>
            </label>
            <input type="text" name="address" value="<?php echo $address; ?>" class="input input-bordered w-full" required>
        </div>

        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text">
                    <i class="fas fa-city mr-2"></i> City
                </span>
            </label>
            <input type="text" name="city" value="<?php echo $city; ?>" class="input input-bordered w-full" required>
        </div>

        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text">
                    <i class="fas fa-phone mr-2"></i> Phone Number
                </span>
            </label>
            <input type="text" name="phone" value="<?php echo $phone; ?>" class="input input-bordered w-full" required>
        </div>

        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text">
                    <i class="fas fa-envelope mr-2"></i> Email
                </span>
            </label>
            <input type="email" name="email" value="<?php echo $email; ?>" class="input input-bordered w-full" required>
        </div>

        <div class="form-control mb-4">
            <label class="label">
                <span class="label-text">
                    <i class="fas fa-star mr-2"></i> Star
                </span>
            </label>
            <input type="number" name="star" value="<?php echo $star; ?>" class="input input-bordered w-full" min="1" max="5" required>
        </div>

        <div class="form-control mt-6">
            <button type="submit" class="btn btn-primary w-full">
                <i class="fas fa-save mr-2"></i> Update Hotel
            </button>
        </div>
    </form>
</div>
