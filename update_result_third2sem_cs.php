<?php
include 'db_conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $cst1 = isset($_POST['CST-3211']) ? trim($_POST['CST-3211']) : null;
    $cst2 = isset($_POST['CST-3242']) ? trim($_POST['CST-3242']) : null;
    $cst3 = isset($_POST['CST-3213']) ? trim($_POST['CST-3213']) : null;
    $cs1  = isset($_POST['CS-3224']) ? trim($_POST['CS-3224']) : null;
    $cst4 = isset($_POST['CST-3235']) ? trim($_POST['CST-3235']) : null;
    $cst5 = isset($_POST['CST-3256']) ? trim($_POST['CST-3256']) : null;
    $cst6 = isset($_POST['CST-3257']) ? trim($_POST['CST-3257']) : null;

    if (empty($id) || empty($roll_no)) {
        $_SESSION['error'] = 'ID and Roll number are required';
        header("Location: third2sem_cs.php");
        exit;
    }

    // Enclose field names with backticks
    $query = "UPDATE third_2sem_cs SET 
                roll_no = ?, 
                `CST-3211` = ?, 
                `CST-3242` = ?, 
                `CST-3213` = ?, 
                `CS-3224` = ?, 
                `CST-3235` = ?, 
                `CST-3256` = ?, 
                `CST-3257` = ?
              WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssssssssi', $roll_no, $cst1, $cst2, $cst3, $cs1, $cst4, $cst5, $cst6, $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = 'Result updated successfully';
    } else {
        $_SESSION['error'] = 'Error updating result: ' . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    header("Location: third2sem_cs.php");
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header("Location: third2sem_cs.php");
    exit;
}

mysqli_close($conn);
?>
