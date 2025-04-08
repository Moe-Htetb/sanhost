<?php
require_once 'db_conn.php';

// Drop the existing admin table to start fresh
$drop_table = "DROP TABLE IF EXISTS admin";
if ($conn->query($drop_table)) {
    echo "Existing admin table dropped successfully<br>";
} else {
    echo "Error dropping table: " . $conn->error . "<br>";
}

// Create admin table
$create_table = "CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($create_table)) {
    echo "Admin table created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Create admin account with proper credentials
$admin_name = "Admin";
$admin_email = "admin@ucshpaan.edu.mm";
$admin_password = password_hash("admin123", PASSWORD_DEFAULT);

// Insert admin account
$insert_admin = "INSERT INTO admin (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($insert_admin);
$stmt->bind_param("sss", $admin_name, $admin_email, $admin_password);

if ($stmt->execute()) {
    echo "Admin account created successfully!<br>";
    echo "Login credentials:<br>";
    echo "Email: admin@ucshpaan.edu.mm<br>";
    echo "Password: admin123<br>";
} else {
    echo "Error creating admin account: " . $stmt->error . "<br>";
}

// Verify the admin account
$verify = "SELECT * FROM admin";
$result = $conn->query($verify);
if ($row = $result->fetch_assoc()) {
    echo "<br>Verification:<br>";
    echo "Admin ID: " . $row['id'] . "<br>";
    echo "Name: " . $row['name'] . "<br>";
    echo "Email: " . $row['email'] . "<br>";
    echo "Password is hashed: " . (strlen($row['password']) > 20 ? "Yes" : "No") . "<br>";
}

$conn->close(); 