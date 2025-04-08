<?php
include 'db_conn.php';
require_once './side_bar.php';


// Display delete success/error messages
if (isset($_GET['delete_success'])) {
    echo '<script>
    Swal.fire({
        title: "Success!",
        text: "Student record deleted successfully.",
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
?>

<?php
// Fetch students from database with all fields
$query = "SELECT id, name, roll_no, email, year, semester, major FROM students ORDER BY name ASC";
$result = mysqli_query($conn, $query);

// Check if query was successful
if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}

// Define options for dropdowns
$yearOptions = ['First Year', 'Second Year', 'Third Year', 'Fourth Year', 'Fifth Year'];
$semesterOptions = ['First Semester', 'Second Semester'];

// To this:
$majorOptions = [
    'First Year' => ['Computer Science and Technology'],
    'other' => ['Computer Science', 'Computer Technology']
]; ?>

<div class="p-4 sm:ml-64">


    <div class="flex items-center flex-col justify-center mb-10 ">
        <h1 class="text-3xl font-bold mt-4">University Of Computer Studies (Hpa-An)</h1>
        <h2 class="text-2xl my-4">Computer Science and Techlogy</h2>
    </div>
    <!-- Header with Title, Search and Add Button -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-800 ">Student Management</h1>

        <div class="flex flex-col sm:flex-row w-full md:w-auto gap-4">
            <!-- Search Box -->
            <div class="relative w-full sm:w-64">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="search-students" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by name, roll no...">
            </div>

            <!-- Add New Student Button -->
            <button id="addNewStdBtn" type="button" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                </svg>
                Add Student
            </button>
        </div>
    </div>

    <?php
    // Show alert for error or success
    if (isset($_GET['error'])) {
        $error = htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8');
        echo "<script>alert('$error');</script>";
    }

    if (isset($_GET['success'])) {
        $success = htmlspecialchars($_GET['success'], ENT_QUOTES, 'UTF-8');
        echo "<script>alert('$success');</script>";
    }
    ?>

    <!-- Student Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Roll Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Student Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Year
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Semester
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Major
                    </th>
                    <th scope="col" class="px-6 py-3 text-right">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php while ($student = mysqli_fetch_assoc($result)): ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?php echo htmlspecialchars($student['roll_no']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($student['name']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($student['email']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($student['year']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($student['semester']); ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo htmlspecialchars($student['major']); ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end space-x-2">
                                <a href="#" onclick="openEditModal(
                                    <?php echo $student['id']; ?>, 
                                    '<?php echo addslashes($student['name']); ?>', 
                                    '<?php echo addslashes($student['roll_no']); ?>', 
                                    '<?php echo addslashes($student['email']); ?>',
                                    '<?php echo addslashes($student['year']); ?>',
                                    '<?php echo addslashes($student['semester']); ?>',
                                    '<?php echo addslashes($student['major']); ?>'
                                )" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <a href="#" onclick="confirmDelete(<?php echo $student['id']; ?>)" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Close database connection
mysqli_close($conn);
?>

<!-- Add Student Modal -->
<div id="add-student-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full items-center justify-center bg-gray-900/50">
    <div class="relative w-full max-w-md max-h-full bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal content -->
        <div class="relative">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Add New Student
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="document.getElementById('add-student-modal').classList.add('hidden');">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-4">
                <form id="add-student-form" action="add_student.php" method="POST">
                    <div class="grid gap-4 mb-4">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name *</label>
                            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John Doe" required>
                        </div>
                        <div>
                            <label for="roll_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Roll Number *</label>
                            <input type="text" id="roll_no" name="roll_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="12345" required>
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email *</label>
                            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@example.com" required>
                        </div>
                        <div>
                            <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year *</label>
                            <select id="year" name="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Select Year</option>
                                <?php foreach ($yearOptions as $year): ?>
                                    <option value="<?php echo htmlspecialchars($year); ?>"><?php echo htmlspecialchars($year); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="semester" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Semester *</label>
                            <select id="semester" name="semester" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Select Semester</option>
                                <?php foreach ($semesterOptions as $semester): ?>
                                    <option value="<?php echo htmlspecialchars($semester); ?>"><?php echo htmlspecialchars($semester); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="major" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Major *</label>
                            <select id="major" name="major" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="">Select Major</option>
                                <?php foreach ($majorOptions['First Year'] as $major): ?>
                                    <option value="<?php echo htmlspecialchars($major); ?>"><?php echo htmlspecialchars($major); ?></option>
                                <?php endforeach; ?>
                                <?php foreach ($majorOptions['other'] as $major): ?>
                                    <option value="<?php echo htmlspecialchars($major); ?>" class="other-year-option" style="display:none"><?php echo htmlspecialchars($major); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center justify-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" form="add-student-form" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div id="edit-student-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full items-center justify-center bg-gray-900/50">
    <div class="relative w-full max-w-md max-h-full bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Modal content -->
        <div class="relative">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Edit Student
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeEditModal()">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-4">
                <form id="edit-student-form" action="update_student.php" method="POST">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="grid gap-4 mb-4">
                        <div>
                            <label for="edit-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name *</label>
                            <input type="text" id="edit-name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="edit-roll_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Roll Number *</label>
                            <input type="text" id="edit-roll_no" name="roll_no" readonly class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-not-allowed" required>
                        </div>
                        <div>
                            <label for="edit-email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email *</label>
                            <input type="email" id="edit-email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div>
                            <label for="edit-year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year *</label>
                            <select id="edit-year" name="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <?php foreach ($yearOptions as $year): ?>
                                    <option value="<?php echo htmlspecialchars($year); ?>"><?php echo htmlspecialchars($year); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="edit-semester" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Semester *</label>
                            <select id="edit-semester" name="semester" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <?php foreach ($semesterOptions as $semester): ?>
                                    <option value="<?php echo htmlspecialchars($semester); ?>"><?php echo htmlspecialchars($semester); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="edit-major" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Major *</label>
                            <select id="edit-major" name="major" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <?php foreach ($majorOptions['First Year'] as $major): ?>
                                    <option value="<?php echo htmlspecialchars($major); ?>"><?php echo htmlspecialchars($major); ?></option>
                                <?php endforeach; ?>
                                <?php foreach ($majorOptions['other'] as $major): ?>
                                    <option value="<?php echo htmlspecialchars($major); ?>" class="other-year-option" style="display:none"><?php echo htmlspecialchars($major); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="flex justify-center items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" form="edit-student-form" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
            </div>
        </div>
    </div>
</div>


<!-- Flowbite JS for modal functionality -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

<script>
    // Add event listeners for the modals
    document.addEventListener('DOMContentLoaded', function() {
        const addNewStdBtn = document.getElementById('addNewStdBtn');
        const addStudentModal = document.getElementById('add-student-modal');
        const editStudentModal = document.getElementById('edit-student-modal');
        const mainContent = document.querySelector('.p-4.sm\\:ml-64');
        const yearSelect = document.getElementById('year');
        const semesterSelect = document.getElementById('semester');
        const majorSelect = document.getElementById('major');
        const otherYearOptions = document.querySelectorAll('.other-year-option');

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

        // Function to open edit modal
        window.openEditModal = function(id, name, roll_no, email, year, semester, major) {
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-roll_no').value = roll_no;
            document.getElementById('edit-roll_no').disabled = true;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-year').value = year;
            document.getElementById('edit-semester').value = semester;
            document.getElementById('edit-major').value = major;
            
            toggleModal(editStudentModal, true);
        }

        // Function to close edit modal
        window.closeEditModal = function() {
            toggleModal(editStudentModal, false);
        }

        // Add New Student button click handler
        addNewStdBtn.addEventListener('click', function() {
            toggleModal(addStudentModal, true);
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === addStudentModal) {
                toggleModal(addStudentModal, false);
            }
            if (event.target === editStudentModal) {
                toggleModal(editStudentModal, false);
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

        // Function to update major options based on year and semester
        function updateMajorOptions() {
            const year = yearSelect.value;
            const semester = semesterSelect.value;
            
            // Hide all options first
            otherYearOptions.forEach(option => {
                option.style.display = 'none';
            });
            const cstOption = Array.from(majorSelect.options).find(opt => opt.value === 'Computer Science and Technology');
            if (cstOption) cstOption.style.display = 'none';

            // Reset major selection
            majorSelect.value = '';

            // Handle semester visibility for Fifth Year
            const secondSemesterOption = Array.from(semesterSelect.options).find(opt => opt.value === 'Second Semester');
            if (year === 'Fifth Year') {
                if (secondSemesterOption) secondSemesterOption.style.display = 'none';
                if (semester === 'Second Semester') {
                    semesterSelect.value = 'First Semester';
                }
            } else {
                if (secondSemesterOption) secondSemesterOption.style.display = 'block';
            }

            // Handle major options based on year and semester
            if (year === 'First Year' || (year === 'Second Year' && semester === 'First Semester')) {
                // Show only CST for First Year (both semesters) and Second Year First Semester
                if (cstOption) {
                    cstOption.style.display = 'block';
                    majorSelect.value = 'Computer Science and Technology';
                }
            } else {
                // For Second Year Second Semester and above, show only CS and CT
                otherYearOptions.forEach(option => {
                    option.style.display = 'block';
                });
                majorSelect.value = otherYearOptions[0].value; // Default to first option (CS)
            }
        }

        // Add event listeners for year and semester changes
        yearSelect.addEventListener('change', updateMajorOptions);
        semesterSelect.addEventListener('change', updateMajorOptions);

        // Initial update
        updateMajorOptions();

        // Also update the edit form
        const editYearSelect = document.getElementById('edit-year');
        const editSemesterSelect = document.getElementById('edit-semester');
        const editMajorSelect = document.getElementById('edit-major');
        const editOtherYearOptions = document.querySelectorAll('#edit-major .other-year-option');

        function updateEditMajorOptions() {
            const year = editYearSelect.value;
            const semester = editSemesterSelect.value;
            
            // Hide all options first
            editOtherYearOptions.forEach(option => {
                option.style.display = 'none';
            });
            const cstOption = Array.from(editMajorSelect.options).find(opt => opt.value === 'Computer Science and Technology');
            if (cstOption) cstOption.style.display = 'none';

            // Handle semester visibility for Fifth Year
            const secondSemesterOption = Array.from(editSemesterSelect.options).find(opt => opt.value === 'Second Semester');
            if (year === 'Fifth Year') {
                if (secondSemesterOption) secondSemesterOption.style.display = 'none';
                if (semester === 'Second Semester') {
                    editSemesterSelect.value = 'First Semester';
                }
            } else {
                if (secondSemesterOption) secondSemesterOption.style.display = 'block';
            }

            // Handle major options based on year and semester
            if (year === 'First Year' || (year === 'Second Year' && semester === 'First Semester')) {
                // Show only CST for First Year (both semesters) and Second Year First Semester
                if (cstOption) {
                    cstOption.style.display = 'block';
                    editMajorSelect.value = 'Computer Science and Technology';
                }
            } else {
                // For Second Year Second Semester and above, show only CS and CT
                editOtherYearOptions.forEach(option => {
                    option.style.display = 'block';
                });
                editMajorSelect.value = editOtherYearOptions[0].value; // Default to first option (CS)
            }
        }

        // Add event listeners for edit form
        if (editYearSelect && editSemesterSelect) {
            editYearSelect.addEventListener('change', updateEditMajorOptions);
            editSemesterSelect.addEventListener('change', updateEditMajorOptions);
        }

        // Search functionality
        const searchInput = document.getElementById('search-students');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const rollNo = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                    const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                    if (name.includes(searchTerm) || rollNo.includes(searchTerm) || email.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });

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
                window.location.href = 'delete_student.php?id=' + id;
            }
        });
    }
</script>

</body>

</html>