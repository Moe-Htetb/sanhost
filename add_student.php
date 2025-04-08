<?php
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $roll_no = mysqli_real_escape_string($conn, $_POST['roll_no']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $major = mysqli_real_escape_string($conn, $_POST['major']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);

    // Check if roll number already exists
    $check_query = "SELECT * FROM students WHERE roll_no = '$roll_no'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Roll number already exists
        header('Location: student_list.php?error=' . urlencode('Roll number already exists.'));
        exit();
    } else {
        // Insert query
        $query = "INSERT INTO students (name, roll_no, email, year, major, semester) 
                  VALUES ('$name', '$roll_no', '$email', '$year', '$major', '$semester')";

        if (mysqli_query($conn, $query)) {
            // Success - redirect back to the main page
            header('Location: student_list.php?success=Student added successfully');
            exit();
        } else {
            // Error
            header('Location: student_list.php?error=' . urlencode(mysqli_error($conn)));
            exit();
        }
    }
}

mysqli_close($conn);
