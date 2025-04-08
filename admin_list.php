<?php
session_start();
include 'db_conn.php';
require_once './side_bar.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Display delete success/error messages
if (isset($_GET['delete_success'])) {
    echo '<script>
    Swal.fire({
        title: "Success!",
        text: "Admin record deleted successfully.",
        icon: "success",
        confirmButtonText: "OK"
    });
    </script>';
} elseif (isset($_GET['delete_error'])) {
    echo '<script>
    Swal.fire({
        title: "Error!",
        text: "' . htmlspecialchars($_GET['delete_error']) . '",
        icon: "error",
        confirmButtonText: "OK"
    });
    </script>';
}

// Fetch all admins
$query = "SELECT id, name, email, password FROM admin ORDER BY name ASC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>

<div class="p-4 sm:ml-64">
    <div class="flex items-center flex-col justify-center mb-10 ">
        <h1 class="text-3xl font-bold mt-4">University Of Computer Studies (Hpa-An)</h1>
        <h2 class="text-2xl my-4">Admin Management</h2>
    </div>

    <!-- Header with Title, Search and Add Button -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Admin Management</h1>

        <div class="flex flex-col sm:flex-row w-full md:w-auto gap-4">
            <!-- Search Box -->
            <div class="relative w-full sm:w-64">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="search-admins" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by name or email...">
            </div>

            <!-- Add New Admin Button -->
            <button id="addNewAdminBtn" type="button" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                </svg>
                Add Admin
            </button>
        </div>
    </div>

    <!-- Admin Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Password</th>
                    <th scope="col" class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($admin = mysqli_fetch_assoc($result)): ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?php echo htmlspecialchars($admin['name']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($admin['email']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo str_repeat('•', 8); ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end space-x-2">
                                <a href="#" onclick="openEditModal(
                                    <?php echo $admin['id']; ?>, 
                                    '<?php echo addslashes($admin['name']); ?>', 
                                    '<?php echo addslashes($admin['email']); ?>'
                                )" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <a href="#" onclick="confirmDelete(<?php echo $admin['id']; ?>)" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Admin Modal -->
    <div id="add-admin-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full items-center justify-center bg-gray-900/50">
        <div class="relative w-full max-w-md max-h-full bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal content -->
            <div class="relative">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Add New Admin
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="document.getElementById('add-admin-modal').classList.add('hidden');">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4">
                    <form id="add-admin-form" action="process_admin.php" method="POST">
                        <input type="hidden" name="action" value="add">
                        <div class="grid gap-4 mb-4">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name *</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email *</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password *</label>
                                <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>
                            <div>
                                <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password *</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" form="add-admin-form" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Admin Modal -->
    <div id="edit-admin-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full items-center justify-center bg-gray-900/50">
        <div class="relative w-full max-w-md max-h-full bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal content -->
            <div class="relative">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit Admin
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="document.getElementById('edit-admin-modal').classList.add('hidden');">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4">
                    <form id="edit-admin-form" action="process_admin.php" method="POST">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="admin_id" id="edit_admin_id">
                        <div class="grid gap-4 mb-4">
                            <div>
                                <label for="edit_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name *</label>
                                <input type="text" name="name" id="edit_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>
                            <div>
                                <label for="edit_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email *</label>
                                <input type="email" name="email" id="edit_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>
                            <div>
                                <label for="edit_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password (leave blank to keep current)</label>
                                <input type="password" name="password" id="edit_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" form="edit-admin-form" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Flowbite JS for modal functionality -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addNewAdminBtn = document.getElementById('addNewAdminBtn');
        const addAdminModal = document.getElementById('add-admin-modal');
        const editAdminModal = document.getElementById('edit-admin-modal');

        // Function to toggle modal
        function toggleModal(modal, show) {
            if (show) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = 'auto';
            }
        }

        // Add New Admin button click handler
        addNewAdminBtn.addEventListener('click', function() {
            toggleModal(addAdminModal, true);
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === addAdminModal) {
                toggleModal(addAdminModal, false);
            }
            if (event.target === editAdminModal) {
                toggleModal(editAdminModal, false);
            }
        });

        // Add click handlers for close buttons
        const closeButtons = document.querySelectorAll('[onclick*="classList.add(\'hidden\')"]');
        closeButtons.forEach(button => {
            const modalId = button.closest('[id$="-modal"]').id;
            const modal = document.getElementById(modalId);
            button.onclick = function(e) {
                e.preventDefault();
                toggleModal(modal, false);
            };
        });
    });

    // Function to open edit modal
    function openEditModal(id, name, email) {
        document.getElementById('edit_admin_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
        
        const editModal = document.getElementById('edit-admin-modal');
        editModal.classList.remove('hidden');
        editModal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    // Function to confirm delete
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `process_admin.php?action=delete&admin_id=${id}`;
            }
        });
    }

    // Search functionality
    const searchInput = document.getElementById('search-admins');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                const email = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                if (name.includes(searchTerm) || email.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }

    // Form validation for add admin
    document.getElementById('add-admin-form').addEventListener('submit', function(e) {
        const password = this.querySelector('input[name="password"]').value;
        const confirmPassword = this.querySelector('input[name="confirm_password"]').value;

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

    // Display messages
    <?php if (isset($_SESSION['message'])): ?>
    Swal.fire({
        title: '<?php echo isset($_SESSION['message_title']) ? $_SESSION['message_title'] : ''; ?>',
        text: '<?php echo $_SESSION['message']; ?>',
        icon: '<?php echo $_SESSION['message_type']; ?>',
        confirmButtonText: 'OK'
    });
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
    unset($_SESSION['message_title']);
    endif;
    ?>
</script>