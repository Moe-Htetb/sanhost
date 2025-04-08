<?php
include 'db_conn.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $math = isset($_POST['M-1201']) ? trim($_POST['M-1201']) : null;
    $english = isset($_POST['E-1201']) ? trim($_POST['E-1201']) : null;
    $physics = isset($_POST['P-1201']) ? trim($_POST['P-1201']) : null;
    $cst1 = isset($_POST['CST-1211']) ? trim($_POST['CST-1211']) : null;
    $cst2 = isset($_POST['CST-1242']) ? trim($_POST['CST-1242']) : null;
    $cst3 = isset($_POST['CST(SS)-1253']) ? trim($_POST['CST(SS)-1253']) : null;

    // Validate required fields
    if (empty($id) || empty($roll_no)) {
        $_SESSION['error'] = 'ID and Roll number are required';
        header("Location: first2sem.php");
        exit;
    }

    // Prepare the SQL query
    $query = "UPDATE first_2sem SET 
                roll_no = ?, 
                `M-1201` = ?, 
                `E-1201` = ?, 
                `P-1201` = ?, 
                `CST-1211` = ?, 
                `CST-1242` = ?, 
                `CST(SS)-1253` = ? 
              WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssssi', $roll_no, $math, $english, $physics, $cst1, $cst2, $cst3, $id);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result updated successfully';
    } else {
        $_SESSION['error'] = 'Error updating result: ' . mysqli_error($conn);
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