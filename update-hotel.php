<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $star = $_POST['star'];

    // Update query
    $query = "UPDATE shiraz SET name = ?, address = ?, city = ?, phone = ?, email = ?, star = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssi", $name, $address, $city, $phone, $email, $star, $id);

    // Execute the query
    if ($stmt->execute()) {
        header("location: list.php?update=done");
    } else {
        echo "Error updating hotel.";
    }

    $stmt->close();
    $conn->close();
}
?>
