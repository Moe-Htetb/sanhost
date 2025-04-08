<?php
include 'db_conn.php';
require_once './side_bar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    
    // Check if username already exists
    $check_query = "SELECT id FROM admins WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $error = "Username already exists";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert new admin
        $query = "INSERT INTO admins (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        
        if (mysqli_query($conn, $query)) {
            header("Location: admin_list.php?success=Admin added successfully");
            exit();
        } else {
            $error = "Error adding admin: " . mysqli_error($conn);
        }
    }
}
?>

<div class="p-4 sm:ml-64">
    <div class="flex items-center flex-col justify-center mb-10">
        <h1 class="text-3xl font-bold mt-4">University Of Computer Studies (Hpa-An)</h1>
        <h2 class="text-2xl my-4">Add New Admin</h2>
    </div>

    <?php if (isset($error)): ?>
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <div class="max-w-md mx-auto">
        <form action="add_admin.php" method="POST" class="space-y-6">
            <div>
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username *</label>
                <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email *</label>
                <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password *</label>
                <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            
            <div>
                <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password *</label>
                <input type="password" id="confirm_password" name="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>

            <div class="flex gap-4 justify-end">
                <a href="admin_list.php" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</a>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Add Admin</button>
            </div>
        </form>
    </div>
</div>

<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (password !== confirmPassword) {
        e.preventDefault();
        Swal.fire({
            title: 'Error!',
            text: 'Passwords do not match',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
});
</script> 