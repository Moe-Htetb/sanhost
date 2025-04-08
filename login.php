<?php
session_start();
require_once 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UCSH</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-50">
    <!-- Back Button -->
    <div class="fixed top-4 left-4">
        <a href="home.php" class="flex items-center text-gray-600 hover:text-gray-900">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Back to Home</span>
        </a>
    </div>

    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <!-- Logo and Title -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome to UCSH</h1>
            <p class="text-gray-600">University of Computer Studies (Hpa-An)</p>
        </div>

        <!-- Login Card -->
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                    <?php 
                    echo htmlspecialchars($_SESSION['error']);
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <!-- Login Type Selector -->
            <div class="flex space-x-4 mb-6">
                <button type="button" id="userBtn" 
                    class="flex-1 py-2.5 px-5 text-sm font-medium text-white bg-blue-600 rounded-lg focus:outline-none">
                    Student Login
                </button>
                <button type="button" id="adminBtn"
                    class="flex-1 py-2.5 px-5 text-sm font-medium text-gray-900 bg-gray-100 rounded-lg focus:outline-none">
                    Admin Login
                </button>
            </div>

            <!-- Student Login Form -->
            <form id="userForm" action="login_process.php" method="POST" class="space-y-4">
                <input type="hidden" name="userType" value="user">
                
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="email" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                </div>

                <div>
                    <label for="rollNo" class="block mb-2 text-sm font-medium text-gray-900">Roll Number</label>
                    <input type="text" name="rollNo" id="rollNo" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                </div>

                <button type="submit" 
                    class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Sign In
                </button>
            </form>

            <!-- Admin Login Form -->
            <form id="adminForm" action="login_process.php" method="POST" class="hidden space-y-4">
                <input type="hidden" name="userType" value="admin">
                
                <div>
                    <label for="adminEmail" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="adminEmail" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" name="password" id="password" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                </div>

                <button type="submit" 
                    class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Sign In
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center text-sm text-gray-500">
            &copy; <?php echo date('Y'); ?> UCSH. All rights reserved.
        </div>
    </div>

    <script>
        const userBtn = document.getElementById('userBtn');
        const adminBtn = document.getElementById('adminBtn');
        const userForm = document.getElementById('userForm');
        const adminForm = document.getElementById('adminForm');

        userBtn.addEventListener('click', () => {
            userBtn.classList.remove('bg-gray-100', 'text-gray-900');
            userBtn.classList.add('bg-blue-600', 'text-white');
            adminBtn.classList.remove('bg-blue-600', 'text-white');
            adminBtn.classList.add('bg-gray-100', 'text-gray-900');
            userForm.classList.remove('hidden');
            adminForm.classList.add('hidden');
        });

        adminBtn.addEventListener('click', () => {
            adminBtn.classList.remove('bg-gray-100', 'text-gray-900');
            adminBtn.classList.add('bg-blue-600', 'text-white');
            userBtn.classList.remove('bg-blue-600', 'text-white');
            userBtn.classList.add('bg-gray-100', 'text-gray-900');
            adminForm.classList.remove('hidden');
            userForm.classList.add('hidden');
        });
    </script>
</body>
</html> 