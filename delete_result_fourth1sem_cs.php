<?php
include 'db_conn.php';
session_start();

// Check if ID parameter is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Prepare the delete query
    $query = "DELETE FROM fourth_1sem_cs WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    
    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result deleted successfully';
    } else {
        $_SESSION['error'] = 'Error deleting result: ' . mysqli_error($conn);
    }
    
    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['error'] = 'Invalid result ID';
}

// Redirect back to the results page
header("Location: fourth1sem_cs.php");
exit;
?>