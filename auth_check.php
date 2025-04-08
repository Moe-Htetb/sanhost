<?php
session_start();

// Function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Function to check if user is an admin
function isAdmin() {
    return isLoggedIn() && isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin';
}

// Function to check if user is a student
function isStudent() {
    return isLoggedIn() && isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'student';
}

// Function to get current user's name
function getUserName() {
    return isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
}

// Function to get current user's email
function getUserEmail() {
    return isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
}

// Function to get current user's roll number (for students)
function getUserRollNo() {
    return isset($_SESSION['user_roll_no']) ? $_SESSION['user_roll_no'] : '';
}
?> 