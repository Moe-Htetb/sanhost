<?php
include 'db_conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roll_no = isset($_POST['roll_no']) ? trim($_POST['roll_no']) : '';
    $e1201 = isset($_POST['E-2201']) ? trim($_POST['E-2201']) : null;
    $cst2211 = isset($_POST['CST-2211']) ? trim($_POST['CST-2211']) : null;
    $cst2242 = isset($_POST['CST-2242']) ? trim($_POST['CST-2242']) : null;
    $cst2223 = isset($_POST['CST-2223']) ? trim($_POST['CST-2223']) : null;
    $cst2234 = isset($_POST['CST-2234']) ? trim($_POST['CST-2234']) : null;
    $cstss2235 = isset($_POST['CST(SS)-2235']) ? trim($_POST['CST(SS)-2235']) : null;

    if (empty($roll_no)) {
        $_SESSION['error'] = 'Roll number is required';
        header("Location: second2sem_ct.php");
        exit;
    }

    $check_query = "SELECT * FROM second_2sem_ct WHERE roll_no = ?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_stmt, 's', $roll_no);
    mysqli_stmt_execute($check_stmt); // ✅ fixed here
    $result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = 'Result for this roll number already exists';
        header("Location: second2sem_ct.php");
        exit;
    }

    $query = "INSERT INTO second_2sem_ct (roll_no, `E-2201`, `CST-2211`, `CST-2242`, `CST-2223`, `CST-2234`, `CST(SS)-2235`)
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssssss', $roll_no, $e1201, $cst2211, $cst2242, $cst2223, $cst2234, $cstss2235);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success'] = 'Result added successfully';
        } else {
            $_SESSION['error'] = 'Error adding result: ' . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error'] = 'Failed to prepare insert statement';
    }

    header("Location: second2sem_ct.php");
    exit;
} else {
    $_SESSION['error'] = 'Invalid request method';
    header("Location: second2sem_ct.php");
    exit;
}

mysqli_close($conn);
?>
