<?php
include 'db_conn.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $math = isset($_POST['M-1201']) ? trim($_POST['M-1201']) : null;
    $english = isset($_POST['E-1201']) ? trim($_POST['E-1201']) : null;
    $physics = isset($_POST['P-1201']) ? trim($_POST['P-1201']) : null;
    $cst1 = isset($_POST['CST-1211']) ? trim($_POST['CST-1211']) : null;
    $cst2 = isset($_POST['CST-1242']) ? trim($_POST['CST-1242']) : null;
    $cst3 = isset($_POST['CST(SS)-1253']) ? trim($_POST['CST(SS)-1253']) : null;

    // Validate required fields
    if (empty($roll_no)) {
        $_SESSION['error'] = 'Roll number is required';
        header("Location: first2sem.php");
        exit;
    }

    // Check if the roll number already exists in the results table
    $check_query = "SELECT * FROM first_2sem WHERE roll_no = ?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_stmt, 's', $roll_no);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = 'Result for this roll number already exists';
        header("Location: first2sem.php");
        exit;
    }

    // Prepare the SQL query
    $query = "INSERT INTO first_2sem (roll_no, `M-1201`, `E-1201`, `P-1201`, `CST-1211`, `CST-1242`, `CST(SS)-1253`) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssss', $roll_no, $math, $english, $physics, $cst1, $cst2, $cst3);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result added successfully';
    } else {
        $_SESSION['error'] = 'Error adding result: ' . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
    
    // Redirect back to the form page
    header("Location: first2sem.php");
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header("Location: first2sem.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>