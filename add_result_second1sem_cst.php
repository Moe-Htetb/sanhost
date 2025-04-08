<?php
include 'db_conn.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $english = isset($_POST['E-1201']) ? trim($_POST['E-1201']) : null;
    $cst1 = isset($_POST['CST-2111']) ? trim($_POST['CST-2111']) : null;
    $cst2 = isset($_POST['CST-1242']) ? trim($_POST['CST-1242']) : null;
    $cst3 = isset($_POST['CST-2133']) ? trim($_POST['CST-2133']) : null;
    $cst4 = isset($_POST['CST-2124']) ? trim($_POST['CST-2124']) : null;
    $cst5 = isset($_POST['CST(SK)-2155']) ? trim($_POST['CST(SK)-2155']) : null;

    // Validate required fields
    if (empty($roll_no)) {
        $_SESSION['error'] = 'Roll number is required';
        header("Location: second1sem_cst.php");
        exit;
    }

    // Check if the roll number already exists in the results table
    $check_query = "SELECT * FROM second_1sem_cst WHERE roll_no = ?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_stmt, 's', $roll_no);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = 'Result for this roll number already exists';
        header("Location: second1sem_cst.php");
        exit;
    }

    // Prepare the SQL query
    $query = "INSERT INTO second_1sem_cst (roll_no, `E-1201`, `CST-2111`, `CST-1242`, `CST-2133`, `CST-2124`, `CST(SK)-2155`) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssss', $roll_no, $english, $cst1, $cst2, $cst3, $cst4, $cst5);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result added successfully';
    } else {
        $_SESSION['error'] = 'Error adding result: ' . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
    
    // Redirect back to the form page
    header("Location: second1sem_cst.php");
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header("Location: second1sem_cst.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>
