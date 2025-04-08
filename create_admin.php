<?php
require_once 'db_conn.php';

// Create admin table if it doesn't exist
$create_table = "CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($create_table) === TRUE) {
    echo "Admin table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Create admin account
$admin_name = "Admin";
$admin_email = "admin@ucshpaan.edu.mm";
// Create a simple password: admin123
$admin_password = password_hash("admin123", PASSWORD_DEFAULT);

// First, delete existing admin if exists (to reset password)
$delete_admin = "DELETE FROM admin WHERE email = ?";
$stmt = $conn->prepare($delete_admin);
$stmt->bind_param("s", $admin_email);
$stmt->execute();

// Insert new admin
$insert_admin = "INSERT INTO admin (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($insert_admin);
$stmt->bind_param("sss", $admin_name, $admin_email, $admin_password);

if ($stmt->execute()) {
    echo "Admin account created successfully<br>";
    echo "Email: admin@ucshpaan.edu.mm<br>";
    echo "Password: admin123<br>";
} else {
    echo "Error creating admin account: " . $stmt->error . "<br>";
}

$conn->close(); 