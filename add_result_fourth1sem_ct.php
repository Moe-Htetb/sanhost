<?php
include 'db_conn.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $e4101 = isset($_POST['E-4101']) ? trim($_POST['E-4101']) : null;
    $cst4111 = isset($_POST['CST-4111']) ? trim($_POST['CST-4111']) : null;
    $ct4132 = isset($_POST['CT-4132']) ? trim($_POST['CT-4132']) : null;
    $ct4133 = isset($_POST['CT-4133']) ? trim($_POST['CT-4133']) : null;
    $ct4134 = isset($_POST['CT-4134']) ? trim($_POST['CT-4134']) : null;
    $cst4125 = isset($_POST['CST-4125']) ? trim($_POST['CST-4125']) : null;

    // Validate required fields
    if (empty($roll_no)) {
        $_SESSION['error'] = 'Roll number is required';
        header("Location: fourth1sem_ct.php");
        exit;
    }

    // Check if the roll number already exists in the results table
    $check_query = "SELECT * FROM fourth_1sem_ct WHERE roll_no = ?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_stmt, 's', $roll_no);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = 'Result for this roll number already exists';
        header("Location: fourth1sem_ct.php");
        exit;
    }

    // Prepare the SQL query
    $query = "INSERT INTO fourth_1sem_ct (roll_no, `E-4101`, `CST-4111`, `CT-4132`, `CT-4133`, `CT-4134`, `CST-4125`) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssss', $roll_no, $e4101, $cst4111, $ct4132, $ct4133, $ct4134, $cst4125);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result added successfully';
    } else {
        $_SESSION['error'] = 'Error adding result: ' . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
    
    // Redirect back to the form page
    header("Location: fourth1sem_ct.php");
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header("Location: fourth1sem_ct.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>
