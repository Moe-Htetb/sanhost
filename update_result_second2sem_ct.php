<?php
include 'db_conn.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $english = isset($_POST['E-2201']) ? trim($_POST['E-2201']) : null;
    $cst1 = isset($_POST['CST-2211']) ? trim($_POST['CST-2211']) : null;
    $cst2 = isset($_POST['CST-2242']) ? trim($_POST['CST-2242']) : null;
    $cst3 = isset($_POST['CST-2223']) ? trim($_POST['CST-2223']) : null;
    $cst4 = isset($_POST['CST-2234']) ? trim($_POST['CST-2234']) : null;
    $cst5 = isset($_POST['CST(SS)-2235']) ? trim($_POST['CST(SS)-2235']) : null;

    // Validate required fields
    if (empty($id) || empty($roll_no)) {
        $_SESSION['error'] = 'ID and Roll number are required';
        header("Location: second2sem_ct.php");
        exit;
    }

    // Correct SQL query with backticks for special-character column names
    $query = "UPDATE second_2sem_ct SET 
                roll_no = ?, 
                `E-2201` = ?, 
                `CST-2211` = ?, 
                `CST-2242` = ?, 
                `CST-2223` = ?, 
                `CST-2234` = ?, 
                `CST(SS)-2235` = ? 
              WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssssi', $roll_no, $english, $cst1, $cst2, $cst3, $cst4, $cst5, $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result updated successfully';
    } else {
        $_SESSION['error'] = 'Error updating result: ' . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    header("Location: second2sem_ct.php");
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header("Location: second2sem_ct.php");
    exit;
}

mysqli_close($conn);
?>
