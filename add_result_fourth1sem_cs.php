<?php
include 'db_conn.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $e4101 = isset($_POST['E-4101']) ? trim($_POST['E-4101']) : null;
    $cst4111 = isset($_POST['CST-4111']) ? trim($_POST['CST-4111']) : null;
    $cs4142 = isset($_POST['CS-4142']) ? trim($_POST['CS-4142']) : null;
    $cs4113 = isset($_POST['CS-4113']) ? trim($_POST['CS-4113']) : null;
    $cs4124 = isset($_POST['CS-4124']) ? trim($_POST['CS-4124']) : null;
    $cst4125 = isset($_POST['CST-4125']) ? trim($_POST['CST-4125']) : null;

    // Validate required fields
    if (empty($roll_no)) {
        $_SESSION['error'] = 'Roll number is required';
        header("Location: fourth1sem_cs.php");
        exit;
    }

    // Check if the roll number already exists in the results table
    $check_query = "SELECT * FROM fourth_1sem_cs WHERE roll_no = ?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_stmt, 's', $roll_no);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = 'Result for this roll number already exists';
        header("Location: fourth1sem_cs.php");
        exit;
    }

    // Prepare the SQL query
    $query = "INSERT INTO fourth_1sem_cs (roll_no, `E-4101`, `CST-4111`, `CS-4142`, `CS-4113`, `CS-4124`, `CST-4125`) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssss', $roll_no, $e4101, $cst4111, $cs4142, $cs4113, $cs4124, $cst4125);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result added successfully';
    } else {
        $_SESSION['error'] = 'Error adding result: ' . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
    
    // Redirect back to the form page
    header("Location: fourth1sem_cs.php");
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header("Location: fourth1sem_cs.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>
