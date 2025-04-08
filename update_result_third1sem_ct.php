<?php
include 'db_conn.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $cst1 = isset($_POST['CST-3131']) ? trim($_POST['CST-3131']) : null;
    $cst2 = isset($_POST['CST-3142']) ? trim($_POST['CST-3142']) : null;
    $cst3 = isset($_POST['CST-3113']) ? trim($_POST['CST-3113']) : null;
    $ct1 = isset($_POST['CT-3134']) ? trim($_POST['CT-3134']) : null;
    $ct2 = isset($_POST['CT-3135']) ? trim($_POST['CT-3135']) : null;
    $ctsk1 = isset($_POST['CT(SK)-3136']) ? trim($_POST['CT(SK)-3136']) : null;
    $cstsk1 = isset($_POST['CST(SK)-3157']) ? trim($_POST['CST(SK)-3157']) : null;

    // Validate required fields
    if (empty($id) || empty($roll_no)) {
        $_SESSION['error'] = 'ID and Roll number are required';
        header("Location: third2sem_ct.php");
        exit;
    }

    // Prepare the SQL query
    $query = "UPDATE `third_1sem_ct` SET 
                `roll_no` = ?, 
                `CST-3131` = ?, 
                `CST-3142` = ?, 
                `CST-3113` = ?, 
                `CT-3134` = ?, 
                `CT-3135` = ?, 
                `CT(SK)-3136` = ?, 
                `CST(SK)-3157` = ?
              WHERE `id` = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssssssssi', $roll_no, $cst1, $cst2, $cst3, $ct1, $ct2, $ctsk1, $cstsk1, $id);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result updated successfully';
    } else {
        $_SESSION['error'] = 'Error updating result: ' . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
    
    // Redirect back to the form page
    header("Location: third1sem_ct.php");
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header("Location: third1sem_ct.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>
