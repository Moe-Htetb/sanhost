<?php
include 'db_conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $cst1 = isset($_POST['CST-3131']) ? trim($_POST['CST-3131']) : null;
    $cst2 = isset($_POST['CST-3142']) ? trim($_POST['CST-3142']) : null;
    $cst3 = isset($_POST['CST-3113']) ? trim($_POST['CST-3113']) : null;
    $cs1 = isset($_POST['CS-3124']) ? trim($_POST['CS-3124']) : null;
    $cs2 = isset($_POST['CS-3125']) ? trim($_POST['CS-3125']) : null;
    $cssk1 = isset($_POST['CS(SK)-3156']) ? trim($_POST['CS(SK)-3156']) : null;
    $cstsk1 = isset($_POST['CST(SK)-3157']) ? trim($_POST['CST(SK)-3157']) : null;

    if (empty($id) || empty($roll_no)) {
        $_SESSION['error'] = 'ID and Roll number are required';
        header("Location: third1sem_cs.php");
        exit;
    }

    $query = "UPDATE third_1sem_cs SET 
                roll_no = ?, 
                `CST-3131` = ?, 
                `CST-3142` = ?, 
                `CST-3113` = ?, 
                `CS-3124` = ?, 
                `CS-3125` = ?, 
                `CS(SK)-3156` = ?, 
                `CST(SK)-3157` = ?
              WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssssssi', $roll_no, $cst1, $cst2, $cst3, $cs1, $cs2, $cssk1, $cstsk1, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success'] = 'Result updated successfully';
        } else {
            $_SESSION['error'] = 'Error updating result: ' . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error'] = 'Prepare failed: ' . mysqli_error($conn);
    }

    header("Location: third1sem_cs.php");
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header("Location: third1sem_cs.php");
    exit;
}

mysqli_close($conn);
?>
