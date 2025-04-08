<?php
include 'db_conn.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $cst1 = isset($_POST['CST-4211']) ? trim($_POST['CST-4211']) : null;
    $cst2 = isset($_POST['CST-4242']) ? trim($_POST['CST-4242']) : null;
    $cs1 = isset($_POST['CS-4223']) ? trim($_POST['CS-4223']) : null;
    $cs2 = isset($_POST['CS-4214']) ? trim($_POST['CS-4214']) : null;
    $cs3 = isset($_POST['CS-4225']) ? trim($_POST['CS-4225']) : null;
    $cst3 = isset($_POST['CST-4257']) ? trim($_POST['CST-4257']) : null;

    // Validate required fields
    if (empty($id) || empty($roll_no)) {
        $_SESSION['error'] = 'ID and Roll number are required';
        header("Location: fourth2sem_cs.php");
        exit;
    }

    // Prepare the SQL query
    $query = "UPDATE fourth_2sem_cs SET 
                roll_no = ?, 
                `CST-4211` = ?, 
                `CST-4242` = ?, 
                `CS-4223` = ?, 
                `CS-4214` = ?, 
                `CS-4225` = ?, 
                `CST-4257` = ?
              WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssssi', $roll_no, $cst1, $cst2, $cs1, $cs2, $cs3, $cst3, $id);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result updated successfully';
    } else {
        $_SESSION['error'] = 'Error updating result: ' . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);

    // Redirect back to the form page
    header("Location: fourth2sem_cs.php");
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header("Location: fourth2sem_cs.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>
