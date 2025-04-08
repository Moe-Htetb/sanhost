<?php
include 'db_conn.php';

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get POST data
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $major = mysqli_real_escape_string($conn, $_POST['major']);

    // Update student record in the database (excluding roll_no)
    $updateQuery = "UPDATE students SET name='$name', email='$email', year='$year', semester='$semester', major='$major' WHERE id=$id";

    if (mysqli_query($conn, $updateQuery)) {
        // If update is successful, redirect with success message
        header('Location: student_list.php?update_success=true');
    } else {
        // If there was an error updating the record
        header('Location: student_list.php?update_error=' . urlencode(mysqli_error($conn)));
    }
}

// Close the database connection
mysqli_close($conn);
?>
