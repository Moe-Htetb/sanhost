<?php
include 'db_conn.php';
require_once 'side_bar.php';

// Fetch fourth year first semester data with student names by joining tables
$query = "SELECT s.*, st.name 
          FROM fourth_1sem_cs s
          LEFT JOIN students st ON s.roll_no = st.roll_no
          ORDER BY s.roll_no ASC";
$result = mysqli_query($conn, $query);

$rollNumberQuery = "SELECT roll_no FROM students where semester = 'First Semester' and year = 'Fourth Year' and major = 'Computer Science' ORDER BY roll_no ASC";
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
        <h2 class="text-2xl my-4">Computer Science</h2>
    </div>
    <!-- Header with Title, Search and Add Button -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <span class="text-2xl font-bold text-gray-800">Fourth Year <small>(First Semester Results)</small></span>

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
                    <th scope="col" class="px-6 py-3">E-4101</th>
                    <th scope="col" class="px-6 py-3">CST-4111</th>
                    <th scope="col" class="px-6 py-3">CS-4142</th>
                    <th scope="col" class="px-6 py-3">CS-4113</th>
                    <th scope="col" class="px-6 py-3">CS-4124</th>
                    <th scope="col" class="px-6 py-3">CST-4125</th>
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
                            <?php echo htmlspecialchars($row['E-4101']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($row['CST-4111']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($row['CS-4142']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($row['CS-4113']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($row['CS-4124']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($row['CST-4125']); ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end space-x-2">
                                <a href="#" onclick="openEditModal(
                                        <?php echo $row['id']; ?>,
                                        '<?php echo addslashes($row['roll_no']); ?>',
                                        '<?php echo addslashes($row['E-4101']); ?>',
                                        '<?php echo addslashes($row['CST-4111']); ?>',
                                        '<?php echo addslashes($row['CS-4142']); ?>',
                                        '<?php echo addslashes($row['CS-4113']); ?>',
                                        '<?php echo addslashes($row['CS-4124']); ?>',
                                        '<?php echo addslashes($row['CST-4125']); ?>'
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
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Add New Result
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="add-result-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-4">
                <form id="add-result-form" action="add_result_fourth1sem_cs.php" method="POST">
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
                            <label for="add-e1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Business English II (E-4101)
                            </label>
                            <input type="number" id="add-e1" name="E-4101" min="0" max="100"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="add-cst1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Analysis of Algorithms (CST-4111)
                            </label>
                            <input type="number" id="add-cst1" name="CST-4111" min="0" max="100"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="add-cs1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Operations Research (CS-4142)
                            </label>
                            <input type="number" id="add-cs1" name="CS-4142" min="0" max="100"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="add-cs2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Computer Vision (CS-4113)
                            </label>
                            <input type="number" id="add-cs2" name="CS-4113" min="0" max="100"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="add-cs3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Information Assurance and Security (CS-4124)
                            </label>
                            <input type="number" id="add-cs3" name="CS-4124" min="0" max="100"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                    dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div>
                            <label for="add-cst2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Software Project Management (CST-4125)
                            </label>
                            <input type="number" id="add-cst2" name="CST-4125" min="0" max="100"
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
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Edit Result
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-result-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-4">
                <form id="edit-result-form" action="update_result_fourth1sem_cs.php" method="POST">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="edit-roll_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Roll Number *</label>
                            <input type="text" id="edit-roll_no" name="roll_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="edit-e1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Business English II (E-4101)</label>
                            <input type="number" id="edit-e1" min="0" max="100" name="E-4101" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="edit-cst1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Analysis of Algorithms (CST-4111)</label>
                            <input type="number" id="edit-cst1" min="0" max="100" name="CST-4111" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="edit-cs1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Operations Research (CS-4142)</label>
                            <input type="number" id="edit-cs1" min="0" max="100" name="CS-4142" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="edit-cs2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Computer Vision (CS-4113)</label>
                            <input type="number" id="edit-cs2" min="0" max="100" name="CS-4113" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="edit-cs3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Information Assurance and Security (CS-4124)</label>
                            <input type="number" id="edit-cs3" min="0" max="100" name="CS-4124" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="edit-cst2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Software Project Management (CST-4125)</label>
                            <input type="number" id="edit-cst2" min="0" max="100" name="CST-4125" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
    window.openEditModal = function(id, rollNo, e1, cst1, cs1, cs2, cs3, cst2) {
        // Set the values in the form
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-roll_no').value = rollNo;
        document.getElementById('edit-e1').value = e1;
        document.getElementById('edit-cst1').value = cst1;
        document.getElementById('edit-cs1').value = cs1;
        document.getElementById('edit-cs2').value = cs2;
        document.getElementById('edit-cs3').value = cs3;
        document.getElementById('edit-cst2').value = cst2;

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
            window.location.href = 'delete_result_fourth1sem_cs.php?id=' + resultId;
        }
    });
}
</script>

</body>
</html>