<?php
include 'db_conn.php';

require_once 'side_bar.php';

// Fetch second semester CST data with student names by joining tables
$query = "SELECT f.*, s.name 
          FROM second_1sem_cst f
          LEFT JOIN students s ON f.roll_no = s.roll_no
          ORDER BY f.roll_no ASC";
$result = mysqli_query($conn, $query);

$rollNumberQuery = "SELECT roll_no FROM students where semester = 'First Semester' and year = 'Second Year'";
$rollNumberResult = mysqli_query($conn, $rollNumberQuery);
$rollNumbers = [];
while ($row = mysqli_fetch_assoc($rollNumberResult)) {
    $rollNumbers[] = $row['roll_no'];
}

// Check if query was successful
if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}
?>

<div class="p-4 sm:ml-64">
    <div class="flex items-center flex-col justify-center ">
        <h1 class="text-3xl font-bold mt-4">University Of Computer Studies (Hpa-An)</h1>
        <h2 class="text-2xl my-4">Computer Science and Technology</h2>
    </div>
    <!-- Header with Title, Search and Add Button -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <span class="text-2xl font-bold text-gray-800">Second Year <small>(First Semester CST Results)</small></span>

        <div class="flex flex-col sm:flex-row w-full md:w-auto gap-4">
            <!-- Search Box -->
            <div class="relative w-full sm:w-64">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="search-results" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by roll no...">
            </div>

            <!-- Add New Result Button -->
            <button id="addNewResultBtn" type="button" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                </svg>
                Add Result
            </button>
        </div>
    </div>

    <!-- Results Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Roll Number</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">E-1201</th>
                    <th scope="col" class="px-6 py-3">CST-2111</th>
                    <th scope="col" class="px-6 py-3">CST-1242</th>
                    <th scope="col" class="px-6 py-3">CST-2133</th>
                    <th scope="col" class="px-6 py-3">CST-2124</th>
                    <th scope="col" class="px-6 py-3">CST(SK)-2155</th>
                    <th scope="col" class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?php echo htmlspecialchars($row['roll_no']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($row['name']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($row['E-1201']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($row['CST-2111']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($row['CST-1242']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($row['CST-2133']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($row['CST-2124']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($row['CST(SK)-2155']); ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end space-x-2">
                                <a href="#" onclick="openEditModal(
                                        <?php echo $row['id']; ?>,
                                        '<?php echo addslashes($row['roll_no']); ?>',
                                        '<?php echo addslashes($row['E-1201']); ?>',
                                        '<?php echo addslashes($row['CST-2111']); ?>',
                                        '<?php echo addslashes($row['CST-1242']); ?>',
                                        '<?php echo addslashes($row['CST-2133']); ?>',
                                        '<?php echo addslashes($row['CST-2124']); ?>',
                                        '<?php echo addslashes($row['CST(SK)-2155']); ?>'
                                    )" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <a href="#" onclick="confirmDelete(<?php echo $row['id']; ?>)" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Result Modal -->
<div id="add-result-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full items-center justify-center bg-gray-900/50">
    <div class="relative w-full max-w-2xl max-h-full bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal content -->
        <div class="relative">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Add New Result
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeAddModal()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-4">
                <form id="add-result-form" action="add_result_second1sem_cst.php" method="POST">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="add-roll_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Roll Number *
                            </label>
                            <select id="add-roll_no" name="roll_no"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                                <option value="">Select Roll Number</option>
                                <?php foreach ($rollNumbers as $rollNo): ?>
                                    <option value="<?php echo htmlspecialchars($rollNo); ?>">
                                        <?php echo htmlspecialchars($rollNo); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label for="add-english" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                English (E-1201)
                            </label>
                            <input type="number" id="add-english" name="E-1201" min="0" max="100"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="add-cst1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                CST-2111
                            </label>
                            <input type="number" id="add-cst1" name="CST-2111" min="0" max="100"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="add-cst2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                CST-1242
                            </label>
                            <input type="number" id="add-cst2" name="CST-1242" min="0" max="100"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="add-cst3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                CST-2133
                            </label>
                            <input type="number" id="add-cst3" name="CST-2133" min="0" max="100"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="add-cst4" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                CST-2124
                            </label>
                            <input type="number" id="add-cst4" name="CST-2124" min="0" max="100"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="add-cst5" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                CST(SK)-2155
                            </label>
                            <input type="number" id="add-cst5" name="CST(SK)-2155" min="0" max="100"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" form="add-result-form" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                <button data-modal-hide="add-result-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Result Modal -->
<div id="edit-result-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full items-center justify-center bg-gray-900/50">
    <div class="relative w-full max-w-2xl max-h-full bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal content -->
        <div class="relative">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Edit Result
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeEditModal()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-4">
                <form id="edit-result-form" action="update_result_second1sem_cst.php" method="POST">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="edit-roll_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Roll Number *</label>
                            <input type="text" id="edit-roll_no" name="roll_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="edit-english" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">English (E-1201)</label>
                            <input type="number" id="edit-english" min="0" max="100" name="E-1201" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="edit-cst1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CST-2111</label>
                            <input type="number" id="edit-cst1" min="0" max="100" name="CST-2111" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="edit-cst2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CST-1242</label>
                            <input type="number" id="edit-cst2" min="0" max="100" name="CST-1242" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="edit-cst3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CST-2133</label>
                            <input type="number" id="edit-cst3" min="0" max="100" name="CST-2133" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="edit-cst4" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CST-2124</label>
                            <input type="number" id="edit-cst4" min="0" max="100" name="CST-2124" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="edit-cst5" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CST(SK)-2155</label>
                            <input type="number" id="edit-cst5" min="0" max="100" name="CST(SK)-2155" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" form="edit-result-form" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                <button data-modal-hide="edit-result-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Flowbite JS for modal functionality -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize modals
    const addModal = document.getElementById('add-result-modal');
    const editModal = document.getElementById('edit-result-modal');

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

    // Add button event
    document.getElementById('addNewResultBtn')?.addEventListener('click', () => {
        toggleModal(addModal, true);
    });

    // Function to close add modal
    window.closeAddModal = function() {
        toggleModal(addModal, false);
    }

    // Close buttons for add modal
    addModal.querySelectorAll('[data-modal-hide="add-result-modal"]').forEach(btn => {
        btn.addEventListener('click', () => closeAddModal());
    });

    // Close on outside click for add modal
    addModal.addEventListener('click', (e) => {
        if (e.target === addModal) {
            closeAddModal();
        }
    });

    // Function to open edit modal
    window.openEditModal = function(id, rollNo, english, cst1, cst2, cst3, cst4, cst5) {
        // Set the values in the form
        document.getElementById('edit-roll_no').disabled = true; // Disable the roll number input
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-roll_no').value = rollNo;
        document.getElementById('edit-english').value = english;
        document.getElementById('edit-cst1').value = cst1;
        document.getElementById('edit-cst2').value = cst2;
        document.getElementById('edit-cst3').value = cst3;
        document.getElementById('edit-cst4').value = cst4;
        document.getElementById('edit-cst5').value = cst5;

        toggleModal(editModal, true);
    }

    // Function to close edit modal
    window.closeEditModal = function() {
        toggleModal(editModal, false);
    }

    // Close buttons for edit modal
    editModal.querySelectorAll('[data-modal-hide="edit-result-modal"]').forEach(btn => {
        btn.addEventListener('click', () => closeEditModal());
    });

    // Close on outside click for edit modal
    editModal.addEventListener('click', (e) => {
        if (e.target === editModal) {
            closeEditModal();
        }
    });

    // Search functionality
    const searchInput = document.getElementById('search-results');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const rollNo = row.querySelector('td:nth-child(1)').textContent.toLowerCase();

                if (rollNo.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
});

function confirmDelete(resultId) {
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
            window.location.href = 'delete_result_second1sem_cst.php?id=' + resultId;
        }
    });
}
</script>

</body>

</html>