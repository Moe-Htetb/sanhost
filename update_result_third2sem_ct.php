<?php
include 'db_conn.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $cst1 = isset($_POST['CST-3211']) ? trim($_POST['CST-3211']) : null;
    $cst2 = isset($_POST['CST-3242']) ? trim($_POST['CST-3242']) : null;
    $cst3 = isset($_POST['CST-3213']) ? trim($_POST['CST-3213']) : null;
    $ct1  = isset($_POST['CT-3235']) ? trim($_POST['CT-3235']) : null;
    $cst4 = isset($_POST['CST-3235']) ? trim($_POST['CST-3235']) : null;
    $cst5 = isset($_POST['CST-3256']) ? trim($_POST['CST-3256']) : null;
    $cstsk1 = isset($_POST['CST-3257']) ? trim($_POST['CST-3257']) : null;

    // Validate required fields
    if (empty($id) || empty($roll_no)) {
        $_SESSION['error'] = 'ID and Roll number are required';
        header("Location: third2sem_ct.php");
        exit;
    }

    // Prepare the SQL query
    $query = "UPDATE third_2sem_ct SET 
                roll_no = ?, 
                `CST-3211` = ?, 
                `CST-3242` = ?, 
                `CST-3213` = ?, 
                `CT-3234` = ?, 
                `CST-3235` = ?, 
                `CST-3256` = ?, 
                `CST-3257` = ?
              WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssssssssi', $roll_no, $cst1, $cst2, $cst3, $ct1, $cst4, $cst5, $cstsk1, $id);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result updated successfully';
    } else {
        $_SESSION['error'] = 'Error updating result: ' . mysqli_error($conn);
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
