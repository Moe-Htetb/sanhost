<?php
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Check if username already exists for other admins
    $check_query = "SELECT id FROM admins WHERE username = '$username' AND id != '$id'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        header("Location: admin_list.php?error=Username already exists");
        exit();
    }

    // Build update query
    if (!empty($password)) {
        // If password is provided, update it along with other fields
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE admins SET username = '$username', email = '$email', password = '$hashed_password' WHERE id = '$id'";
    } else {
        // If no password provided, only update username and email
        $query = "UPDATE admins SET username = '$username', email = '$email' WHERE id = '$id'";
    }

    if (mysqli_query($conn, $query)) {
        header("Location: admin_list.php?success=Admin updated successfully");
    } else {
        header("Location: admin_list.php?error=" . urlencode("Error updating admin: " . mysqli_error($conn)));
    }
} else {
    header("Location: admin_list.php");
}

exit(); 