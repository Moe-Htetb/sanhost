<?php
include 'db_conn.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $english = isset($_POST['E-5101']) ? trim($_POST['E-5101']) : null;
    $cst1 = isset($_POST['CST-5141']) ? trim($_POST['CST-5141']) : null;
    $cst2 = isset($_POST['CST-5102']) ? trim($_POST['CST-5102']) : null;
    $cs1 = isset($_POST['CS-5123']) ? trim($_POST['CS-5123']) : null;
    $cs2 = isset($_POST['CS-5114']) ? trim($_POST['CS-5114']) : null;
    $cs3 = isset($_POST['CS-5125']) ? trim($_POST['CS-5125']) : null;

    // Validate required fields
    if (empty($id) || empty($roll_no)) {
        $_SESSION['error'] = 'ID and Roll number are required';
        header("Location: fifth1sem_cs.php");
        exit;
    }

    // Prepare the SQL query
    $query = "UPDATE fifth_1sem_cs SET 
                roll_no = ?, 
                `E-5101` = ?, 
                `CST-5141` = ?, 
                `CST-5102` = ?, 
                `CS-5123` = ?, 
                `CS-5114` = ?, 
                `CS-5125` = ?
              WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssssi', $roll_no, $english, $cst1, $cst2, $cs1, $cs2, $cs3, $id);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result updated successfully';
    } else {
        $_SESSION['error'] = 'Error updating result: ' . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);

    // Redirect back to the form page
    header("Location: fifth1sem_cs.php");
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header("Location: fifth1sem_cs.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>
