<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'resultsystem';
$port = 3306;
$socket = '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock';

try {
    $conn = new mysqli($host, $user, $password, $database, $port, $socket);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset to handle special characters correctly
    $conn->set_charset("utf8mb4");
    
} catch (Exception $e) {
    die("Database Error: " . $e->getMessage());
}
