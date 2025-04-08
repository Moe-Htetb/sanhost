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
    $cs1 = isset($_POST['CS-4142']) ? trim($_POST['CS-4142']) : null;
    $cs2 = isset($_POST['CS-4113']) ? trim($_POST['CS-4113']) : null;
    $cs3 = isset($_POST['CS-4124']) ? trim($_POST['CS-4124']) : null;
    $cst2 = isset($_POST['CST-4125']) ? trim($_POST['CST-4125']) : null;

    // Validate required fields
    if (empty($id) || empty($roll_no)) {
        $_SESSION['error'] = 'ID and Roll number are required';
        header("Location: fourth1sem_cs.php");
        exit;
    }

    // Prepare the SQL query (use backticks for column names)
    $query = "UPDATE `fourth_1sem_cs` SET 
                `roll_no` = ?, 
                `E-4101` = ?, 
                `CST-4111` = ?, 
                `CS-4142` = ?, 
                `CS-4113` = ?, 
                `CS-4124` = ?, 
                `CST-4125` = ?
              WHERE `id` = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssssi', $roll_no, $english, $cst1, $cs1, $cs2, $cs3, $cst2, $id);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result updated successfully';
    } else {
        $_SESSION['error'] = 'Error updating result: ' . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);

    // Redirect back to the form page
    header("Location: fourth1sem_cs.php");
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header("Location: fourth1sem_cs.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>
