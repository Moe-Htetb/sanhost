<?php
include 'db_conn.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $english = isset($_POST['E-4101']) ? trim($_POST['E-4101']) : null;
    $cst1 = isset($_POST['CST-4111']) ? trim($_POST['CST-4111']) : null;
    $ct1 = isset($_POST['CT-4132']) ? trim($_POST['CT-4132']) : null;
    $ct2 = isset($_POST['CT-4133']) ? trim($_POST['CT-4133']) : null;
    $ct3 = isset($_POST['CT-4134']) ? trim($_POST['CT-4134']) : null;
    $cst2 = isset($_POST['CST-4125']) ? trim($_POST['CST-4125']) : null;

    // Validate required fields
    if (empty($id) || empty($roll_no)) {
        $_SESSION['error'] = 'ID and Roll number are required';
        header("Location: fourth1sem_ct.php");
        exit;
    }

    // Prepare the SQL query
    $query = "UPDATE fourth_1sem_ct SET 
                roll_no = ?, 
                `E-4101` = ?, 
                `CST-4111` = ?, 
                `CT-4132` = ?, 
                `CT-4133` = ?, 
                `CT-4134` = ?, 
                `CST-4125` = ?
              WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssssi', $roll_no, $english, $cst1, $ct1, $ct2, $ct3, $cst2, $id);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result updated successfully';
    } else {
        $_SESSION['error'] = 'Error updating result: ' . mysqli_error($conn);
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
