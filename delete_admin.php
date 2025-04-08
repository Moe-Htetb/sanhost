<?php
include 'db_conn.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Check if this is the last admin
    $count_query = "SELECT COUNT(*) as count FROM admins";
    $count_result = mysqli_query($conn, $count_query);
    $count_row = mysqli_fetch_assoc($count_result);
    
    if ($count_row['count'] <= 1) {
        header("Location: admin_list.php?error=Cannot delete the last admin");
        exit();
    }
    
    // Delete the admin
    $query = "DELETE FROM admins WHERE id = '$id'";
    
    if (mysqli_query($conn, $query)) {
        header("Location: admin_list.php?success=Admin deleted successfully");
    } else {
        header("Location: admin_list.php?error=" . urlencode("Error deleting admin: " . mysqli_error($conn)));
    }
} else {
    header("Location: admin_list.php");
}

exit(); 