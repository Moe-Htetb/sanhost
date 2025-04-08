<?php
include 'db_conn.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $english = isset($_POST['E-2201']) ? trim($_POST['E-2201']) : null;
    $data_structure = isset($_POST['CST-2211']) ? trim($_POST['CST-2211']) : null;
    $linear_algebra = isset($_POST['CST-2242']) ? trim($_POST['CST-2242']) : null;
    $software_engineering = isset($_POST['CST-2223']) ? trim($_POST['CST-2223']) : null;
    $web_technology = isset($_POST['CST-2254']) ? trim($_POST['CST-2254']) : null;
    $j2ee_programming = isset($_POST['CST(SS)-2205']) ? trim($_POST['CST(SS)-2205']) : null;

    // Validate required fields
    if (empty($id) || empty($roll_no)) {
        $_SESSION['error'] = 'ID and Roll number are required';
        header("Location: second2sem_cs.php");
        exit;
    }

    // Prepare the SQL query for second-semester result update
    $query = "UPDATE second_2sem_cs SET 
                roll_no = ?, 
                `E-2201` = ?, 
                `CST-2211` = ?, 
                `CST-2242` = ?, 
                `CST-2223` = ?, 
                `CST-2254` = ?, 
                `CST(SS)-2205` = ? 
              WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssssi', $roll_no, $english, $data_structure, $linear_algebra, $software_engineering, $web_technology, $j2ee_programming, $id);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result updated successfully';
    } else {
        $_SESSION['error'] = 'Error updating result: ' . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);

    // Redirect back to the form page
    header("Location: second2sem_cs.php");
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header("Location: second2sem_cs.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>
