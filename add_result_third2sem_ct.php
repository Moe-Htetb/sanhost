<?php
include 'db_conn.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $cst3211 = isset($_POST['CST-3211']) ? trim($_POST['CST-3211']) : null;
    $cst3242 = isset($_POST['CST-3242']) ? trim($_POST['CST-3242']) : null;
    $cst3213 = isset($_POST['CST-3213']) ? trim($_POST['CST-3213']) : null;
    $ct3234 = isset($_POST['CT-3234']) ? trim($_POST['CT-3234']) : null;
    $cst3235 = isset($_POST['CST-3235']) ? trim($_POST['CST-3235']) : null;
    $cst3256 = isset($_POST['CST-3256']) ? trim($_POST['CST-3256']) : null;
    $cst3257 = isset($_POST['CST-3257']) ? trim($_POST['CST-3257']) : null;

    // Validate required fields
    if (empty($roll_no)) {
        $_SESSION['error'] = 'Roll number is required';
        header("Location: third2sem_ct.php");
        exit;
    }

    // Check if the roll number already exists in the results table
    $check_query = "SELECT * FROM third_2sem_ct WHERE roll_no = ?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_stmt, 's', $roll_no);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = 'Result for this roll number already exists';
        header("Location: third2sem_ct.php");
        exit;
    }

    // Prepare the SQL query
    $query = "INSERT INTO third_2sem_ct (roll_no, `CST-3211`, `CST-3242`, `CST-3213`, `CT-3234`, `CST-3235`, `CST-3256`, `CST-3257`) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssssssss', $roll_no, $cst3211, $cst3242, $cst3213, $ct3234, $cst3235, $cst3256, $cst3257);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result added successfully';
    } else {
        $_SESSION['error'] = 'Error adding result: ' . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
    
    // Redirect back to the form page
    header("Location: third2sem_ct.php");
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header("Location: third2sem_ct.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>
