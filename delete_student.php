<?php
include 'db_conn.php';

// Check if ID parameter exists
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $student_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // First, verify the student exists
    $check_query = "SELECT id FROM students WHERE id = '$student_id'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        // Student exists, proceed with deletion
        $delete_query = "DELETE FROM students WHERE id = '$student_id'";
        
        if (mysqli_query($conn, $delete_query)) {
            // Deletion successful
            header('Location: student_list.php?delete_success=1');
            exit();
        } else {
            // Error in deletion
            header('Location: student_list.php?delete_error=' . urlencode(mysqli_error($conn)));
            exit();
        }
    } else {
        // Student doesn't exist
        header('Location: index.php?delete_error=' . urlencode('Student not found'));
        exit();
    }
} else {
    // No ID provided
    header('Location: index.php?delete_error=' . urlencode('Invalid request'));
    exit();
}

mysqli_close($conn);
?>