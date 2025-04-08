<?php
session_start();
include 'db_conn.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}

function set_message($message, $type = 'error', $title = '') {
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
    $_SESSION['message_title'] = $title;
}

// Handle Add Admin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    
    // Check if name already exists
    $check_query = "SELECT id FROM admin WHERE name = '$name'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        set_message('Name already exists', 'error', 'Error');
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert new admin
        $query = "INSERT INTO admin (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
        
        if (mysqli_query($conn, $query)) {
            set_message('Admin added successfully', 'success', 'Success');
        } else {
            set_message('Error adding admin: ' . mysqli_error($conn), 'error', 'Error');
        }
    }
    header("Location: admin_list.php");
    exit();
}

// Handle Edit Admin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $id = mysqli_real_escape_string($conn, $_POST['admin_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Check if name exists for other admins
    $check_query = "SELECT id FROM admin WHERE name = '$name' AND id != '$id'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        set_message('Name already exists', 'error', 'Error');
    } else {
        // Build update query based on whether password was provided
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE admin SET name = '$name', email = '$email', password = '$hashed_password' WHERE id = '$id'";
        } else {
            $query = "UPDATE admin SET name = '$name', email = '$email' WHERE id = '$id'";
        }

        if (mysqli_query($conn, $query)) {
            set_message('Admin updated successfully', 'success', 'Success');
        } else {
            set_message('Error updating admin: ' . mysqli_error($conn), 'error', 'Error');
        }
    }
    header("Location: admin_list.php");
    exit();
}

// Handle Delete Admin
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = mysqli_real_escape_string($conn, $_GET['admin_id']);
    
    // Check if this is the last admin
    $count_query = "SELECT COUNT(*) as count FROM admin";
    $count_result = mysqli_query($conn, $count_query);
    $count_row = mysqli_fetch_assoc($count_result);
    
    if ($count_row['count'] <= 1) {
        set_message('Cannot delete the last admin', 'error', 'Error');
    } else {
        // Check if trying to delete self
        if ($id == $_SESSION['user_id']) {
            set_message('Cannot delete your own account', 'error', 'Error');
        } else {
            $query = "DELETE FROM admin WHERE id = '$id'";
            if (mysqli_query($conn, $query)) {
                set_message('Admin deleted successfully', 'success', 'Success');
            } else {
                set_message('Error deleting admin: ' . mysqli_error($conn), 'error', 'Error');
            }
        }
    }
    header("Location: admin_list.php");
    exit();
}

// If no valid action is specified
header("Location: admin_list.php");
exit(); 