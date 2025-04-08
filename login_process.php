<?php
session_start();
require_once 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userType = $_POST['userType'] ?? '';
    
    if ($userType === 'admin') {
        // Admin login
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        
        // Validate email domain for admin
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !str_ends_with($email, '@ucshpaan.edu.mm')) {
            $_SESSION['error'] = 'Invalid admin email domain';
            header('Location: login.php');
            exit;
        }
        
        // Check admin credentials
        $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_type'] = 'admin';
                
                // Redirect to admin dashboard
                header('Location: student_list.php');
                exit;
            }
        }
        
        $_SESSION['error'] = 'Invalid email or password';
        
    } else {
        // Student login
        $email = trim($_POST['email'] ?? '');
        $rollNo = trim($_POST['rollNo'] ?? '');
        
        // Check student credentials
        $stmt = $conn->prepare("SELECT * FROM students WHERE email = ? AND roll_no = ?");
        $stmt->bind_param("ss", $email, $rollNo);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            // Set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_roll_no'] = $row['roll_no'];
            $_SESSION['user_type'] = 'student';
            
            // Redirect to student dashboard
            header('Location: home.php');
            exit;
        }
        
        $_SESSION['error'] = 'Invalid email or roll number';
    }
    
    header('Location: login.php');
    exit;
}

// If not POST request, redirect to login page
header('Location: login.php');
exit;
?> 