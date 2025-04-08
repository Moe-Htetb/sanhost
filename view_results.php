<?php
session_start();
require_once 'auth_check.php';
require_once 'db_conn.php';

// Check if user is logged in and is a student
if (!isLoggedIn() || !isStudent()) {
    $_SESSION['error'] = 'Please log in as a student to view results';
    header('Location: login.php');
    exit;
}

// Get form data
$year = isset($_POST['year']) ? (int)$_POST['year'] : 0;
$semester = isset($_POST['semester']) ? (int)$_POST['semester'] : 0;
$course_type = isset($_POST['course_type']) ? $_POST['course_type'] : '';

// Determine the table name
$table_name = "";
switch ($year) {
    case 1: $table_name = "first"; break;
    case 2: $table_name = "second"; break;
    case 3: $table_name = "third"; break;
    case 4: $table_name = "fourth"; break;
    case 5: $table_name = "fifth"; break;
    default:
        $_SESSION['error'] = 'Invalid year selected';
        header('Location: home.php');
        exit;
}

$table_name .= "_" . $semester . "sem";

// For second year first semester, append _cst
if ($year === 2 && $semester === 1) {
    $table_name .= "_cst";
} else if ($course_type !== 'cst') {
    // For other years/semesters, append course type if not CST
    $table_name .= "_" . $course_type;
}

// Debug info
error_log("Table name: " . $table_name);
error_log("Year: " . $year);
error_log("Semester: " . $semester);
error_log("Course type: " . $course_type);

// Query to fetch all results
$query = "SELECT * FROM $table_name";
$result = mysqli_query($conn, $query);

if (!$result) {
    $_SESSION['error'] = 'Error fetching results: ' . mysqli_error($conn);
    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Results - UCSH</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mx-auto h-auto px-3 md:px-20 lg:px-32">
        <!-- navigation -->
        <nav class="bg-gray-300 sticky top-3 z-40 border-gray-200 h-auto rounded-md px-2 py-1 mt-5 md:mt-4 lg:mt-7 mx-auto w-full">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2">
                <a class="flex items-center space-x-3 rtl:space-x-reverse" href="home.php">
                    <img src="./assets/IMG_8564.JPG" class="h-8 rounded-full" alt="UCSH Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap text-black">UCSH</span>
                </a>
                <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
                        <li>
                            <a href="home.php" class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Events</a>
                        </li>
                        <li>
                            <?php if (isLoggedIn()): ?>
                                <a href="logout.php" class="block px-4 py-1 text-sm text-white bg-black rounded-md hover:bg-gray-800">Logout</a>
                            <?php else: ?>
                                <a href="login.php" class="block px-4 py-1 text-sm text-white bg-black rounded-md hover:bg-gray-800">Sign In</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- nav end--------- -->

        <div class="container mx-auto px-4 py-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">
                    Results for <?php 
                        $yearText = '';
                        switch($year) {
                            case 1: $yearText = 'First'; break;
                            case 2: $yearText = 'Second'; break;
                            case 3: $yearText = 'Third'; break;
                            case 4: $yearText = 'Fourth'; break;
                            case 5: $yearText = 'Fifth'; break;
                        }
                        echo $yearText . ' Year, ';
                        echo $semester == 1 ? 'First' : 'Second';
                        echo ' Semester';
                    ?> 
                    (<?php echo strtoupper($course_type); ?>)
                </h1>
                <!-- Search Box -->
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="search-results" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Search by roll no...">
                    </div>
                    <a href="home.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
                </div>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?php 
                        echo htmlspecialchars($_SESSION['error']);
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 text-sm">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border-b text-left whitespace-nowrap">Roll No</th>
                            <?php
                            if ($row = mysqli_fetch_assoc($result)) {
                                foreach ($row as $column => $value) {
                                    if ($column !== 'id' && $column !== 'roll_no') {
                                        echo '<th class="px-4 py-2 border-b text-left whitespace-nowrap">' . htmlspecialchars($column) . '</th>';
                                    }
                                }
                                mysqli_data_seek($result, 0);
                            }
                            ?>
                            <th class="px-4 py-2 border-b text-center whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border-b whitespace-nowrap">
                                    <?php echo htmlspecialchars($row['roll_no']); ?>
                                </td>
                                <?php
                                foreach ($row as $column => $value) {
                                    if ($column !== 'id' && $column !== 'roll_no') {
                                        echo '<td class="px-4 py-2 border-b whitespace-nowrap">' . 
                                             ($value !== null ? htmlspecialchars($value) : '-') . 
                                             '</td>';
                                    }
                                }
                                ?>
                                <td class="px-4 py-2 border-b text-center whitespace-nowrap">
                                    <form action="result.php" method="POST" class="inline">
                                        <input type="hidden" name="roll_no" value="<?php echo htmlspecialchars($row['roll_no']); ?>">
                                        <input type="hidden" name="year" value="<?php echo $year; ?>">
                                        <input type="hidden" name="semester" value="<?php echo $semester; ?>">
                                        <input type="hidden" name="course_type" value="<?php echo $course_type; ?>">
                                        <button type="submit" class="bg-blue-500 text-white px-3 py-1 text-sm rounded hover:bg-blue-600">
                                            View Record
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Add search functionality
        const searchInput = document.getElementById('search-results');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const rollNo = row.querySelector('td:first-child').textContent.toLowerCase();
                    if (rollNo.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html> 