<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIST</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    // Example logic to check if user is logged in
    $isLoggedIn = isset($_SESSION['user_id']); // Change this based on your authentication logic
    include 'navbar.php';
    include 'conn.php';

    // Check if the search form was submitted
    if (isset($_GET['search-btn']) && isset($_GET['search'])) {
        $search = $_GET['search'];

        // Prepare the SQL statement with LIKE for partial matches
        $sql = "SELECT * FROM shiraz WHERE name LIKE ? OR city LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchTerm = '%' . $search . '%';
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        // If no search term, display all records
        $sql = "SELECT * FROM shiraz";
        $result = $conn->query($sql);
    }
    if(isset($_GET['update']) && $_GET['update']=='done'){
        echo "<p class ='alert alert-success'>Hotel Updated</p>";
    }

    if(isset($_GET['insert']) && $_GET['insert']=='done'){
        echo "<p class ='alert alert-success'>Hotel Inserted</p>";
    }
    ?>
    <div class="container mx-auto mt-8">
        <h1 class="text-4xl font-bold mb-6 text-center">SHIRAZ</h1>
        <div class="overflow-x-auto">
            <table class="table w-full table-zebra">
                <thead class="bg-gray-200 text-white">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Star</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id = $row['id'];
                            echo "<tr class='hover:bg-gray-100'>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['address']}</td>
                                    <td>{$row['city']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['star']}</td>
                                    <td>
                                        <a href='edit-hotel.php?id=$id'><button class='btn btn-sm btn-primary'>EDIT</button></a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // JavaScript for Hamburger Menu
        document.getElementById('hamburger-menu').addEventListener('click', function() {
            document.getElementById('dropdown-menu').classList.toggle('show');
        });

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
</body>
</html>
