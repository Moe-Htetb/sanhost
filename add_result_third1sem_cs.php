<?php
include 'db_conn.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $cst3131 = isset($_POST['CST-3131']) ? trim($_POST['CST-3131']) : null;
    $cst3142 = isset($_POST['CST-3142']) ? trim($_POST['CST-3142']) : null;
    $cst3113 = isset($_POST['CST-3113']) ? trim($_POST['CST-3113']) : null;
    $cs3124 = isset($_POST['CS-3124']) ? trim($_POST['CS-3124']) : null;
    $cs3125 = isset($_POST['CS-3125']) ? trim($_POST['CS-3125']) : null;
    $cssk3156 = isset($_POST['CS(SK)-3156']) ? trim($_POST['CS(SK)-3156']) : null;
    $cstsk3157 = isset($_POST['CST(SK)-3157']) ? trim($_POST['CST(SK)-3157']) : null;

    // Validate required fields
    if (empty($roll_no)) {
        $_SESSION['error'] = 'Roll number is required';
        header("Location: third1sem_cs.php");
        exit;
    }

    // Check if the roll number already exists in the results table
    $check_query = "SELECT * FROM third_1sem_cs WHERE roll_no = ?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_stmt, 's', $roll_no);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = 'Result for this roll number already exists';
        header("Location: third1sem_cs.php");
        exit;
    }

    // Prepare the SQL query
    $query = "INSERT INTO third_1sem_cs (roll_no, `CST-3131`, `CST-3142`, `CST-3113`, `CS-3124`, `CS-3125`, `CS(SK)-3156`, `CST(SK)-3157`) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssssssss', $roll_no, $cst3131, $cst3142, $cst3113, $cs3124, $cs3125, $cssk3156, $cstsk3157);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result added successfully';
    } else {
        $_SESSION['error'] = 'Error adding result: ' . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
    
    // Redirect back to the form page
    header("Location: third1sem_cs.php");
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header("Location: third1sem_cs.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>
