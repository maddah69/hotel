<?php
include 'conn.php';

    $name =$_POST['name'];
    $family =$_POST['family'];
    $mobile =$_POST['mobile'];
    $email =$_POST['email'];
    $password =$_POST['password'];
    $confirmpassword =$_POST['confirmpassword'];

    // Validate password confirmation
    if ($password !== $confirmpassword) {
        $error_message = 'Passwords do not match.';
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert data into the database
        $sql = "INSERT INTO admins (name, family, mobile, email, password) 
                VALUES ('$name', '$family', '$mobile', '$email', '$hashed_password')";
                    mysqli_query($conn , $sql);
                    header("location: list.php");


}
?>