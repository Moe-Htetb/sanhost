<?php
include 'db_conn.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $e5101 = isset($_POST['E-5101']) ? trim($_POST['E-5101']) : null;
    $cst5141 = isset($_POST['CST-5141']) ? trim($_POST['CST-5141']) : null;
    $cst5102 = isset($_POST['CST-5102']) ? trim($_POST['CST-5102']) : null;
    $cs5123 = isset($_POST['CS-5123']) ? trim($_POST['CS-5123']) : null;
    $cs5114 = isset($_POST['CS-5114']) ? trim($_POST['CS-5114']) : null;
    $cs5125 = isset($_POST['CS-5125']) ? trim($_POST['CS-5125']) : null;

    // Validate required fields
    if (empty($roll_no)) {
        $_SESSION['error'] = 'Roll number is required';
        header("Location: fifth1sem_cs.php");
        exit;
    }

    // Check if the roll number already exists in the results table
    $check_query = "SELECT * FROM fifth_1sem_cs WHERE roll_no = ?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_stmt, 's', $roll_no);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = 'Result for this roll number already exists';
        header("Location: fifth1sem_cs.php");
        exit;
    }

    // Prepare the SQL query
    $query = "INSERT INTO fifth_1sem_cs (roll_no, `E-5101`, `CST-5141`, `CST-5102`, `CS-5123`, `CS-5114`, `CS-5125`)
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssss', $roll_no, $e5101, $cst5141, $cst5102, $cs5123, $cs5114, $cs5125);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result added successfully';
    } else {
        $_SESSION['error'] = 'Error adding result: ' . mysqli_error($conn);
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
