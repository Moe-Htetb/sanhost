<?php
include 'db_conn.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $cst4211 = isset($_POST['CST-4211']) ? trim($_POST['CST-4211']) : null;
    $cst4242 = isset($_POST['CST-4242']) ? trim($_POST['CST-4242']) : null;
    $cs4223 = isset($_POST['CS-4223']) ? trim($_POST['CS-4223']) : null;
    $cs4214 = isset($_POST['CS-4214']) ? trim($_POST['CS-4214']) : null;
    $cs4225 = isset($_POST['CS-4225']) ? trim($_POST['CS-4225']) : null;
    $cst4257 = isset($_POST['CST-4257']) ? trim($_POST['CST-4257']) : null;

    // Validate required fields
    if (empty($roll_no)) {
        $_SESSION['error'] = 'Roll number is required';
        header("Location: fourth2sem_cs.php");
        exit;
    }

    // Check if the roll number already exists in the results table
    $check_query = "SELECT * FROM fourth_2sem_cs WHERE roll_no = ?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_stmt, 's', $roll_no);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = 'Result for this roll number already exists';
        header("Location: fourth2sem_cs.php");
        exit;
    }

    // Prepare the SQL query
    $query = "INSERT INTO fourth_2sem_cs (roll_no, `CST-4211`, `CST-4242`, `CS-4223`, `CS-4214`, `CS-4225`, `CST-4257`)
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssss', $roll_no, $cst4211, $cst4242, $cs4223, $cs4214, $cs4225, $cst4257);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result added successfully';
    } else {
        $_SESSION['error'] = 'Error adding result: ' . mysqli_error($conn);
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
