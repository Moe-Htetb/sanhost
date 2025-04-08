<?php
session_start(); // Start session before any output
require_once 'auth_check.php';
require_once 'db_conn.php';

// Debug session info
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year = isset($_POST['year']) ? (int)$_POST['year'] : 0;
    $semester = isset($_POST['semester']) ? (int)$_POST['semester'] : 0;
    $course_type = isset($_POST['course_type']) ? $_POST['course_type'] : '';
    $roll_no = isset($_POST['roll_no']) ? $_POST['roll_no'] : '';

    if (!isLoggedIn() || !isStudent()) {
        $_SESSION['error'] = 'Please log in as a student to view results';
        header('Location: login.php');
        exit;
    }

    // Determine the table name based on year, semester and course type
    $table_name = "";
    switch ($year) {
        case 1:
            $table_name = "first";
            break;
        case 2:
            $table_name = "second";
            break;
        case 3:
            $table_name = "third";
            break;
        case 4:
            $table_name = "fourth";
            break;
        case 5:
            $table_name = "fifth";
            break;
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
    error_log("Roll no: " . $roll_no);
    error_log("Year: " . $year);
    error_log("Semester: " . $semester);
    error_log("Course type: " . $course_type);

    // Define subject names mapping
    $subject_names = [
        // First Year First Semester (CST)
        'M-1101' => 'Myanmar',
        'E-1101' => 'English',
        'P-1101' => 'Physics',
        'CST-1111' => 'Principle of Information Technology',
        'CST-1142' => 'Mathematics of Computing (Calculus I)',
        'CST(SS-1123)' => 'Microsoft Office 365',
        
        // First Year Second Semester (CST)
        'M-1201' => 'Myanmar',
        'E-1201' => 'English',
        'P-1201' => 'Physics',
        'CST-1211' => 'Programming Logic & Design (Programming in C++)',
        'CST-1242' => 'Discrete 1',
        'CST(SS)-1253' => 'Microsoft Office 365',
        
        // Second Year First Semester (CST)
        'E-1201' => 'Proficiency English III',
        'CST-2111' => 'Programming Language Skill (Java)',
        'CST-1242' => 'Calculus II',
        'CST-2133' => 'Digital Logic Design',
        'CST-2124' => 'Database Management System',
        'CST(SK)-2155' => 'Web-based Development (HTML 5+ CSS)',
        
        // Second Year Second Semester (CS)
        'E-1201' => 'English',
        'CST-2211' => 'Data Structure and Algorithms',
        'CST-2242' => 'Linear Algebra',
        'CST-2223' => 'Software Engineering',
        'CST-2254' => 'Web Technology (Java Script Programming)',
        'CST(SS)-2205' => 'J2EE Programming',
        
        // Second Year Second Semester (CT)
        'E-1201' => 'English',
        'CST-2211' => 'Data Structure and Algorithms',
        'CST-2242' => 'Linear Algebra',
        'CST-2223' => 'Software Engineering',
        'CST-2234' => 'Circuit and Electronics',
        'CST(SS)-2235' => 'Arduino Fundamentals',
        
        // Third Year First Semester (CS)
        'CST-3131' => 'Computer Architecture and Organization I',
        'CST-3142' => 'Differential Equations and Numerical Analysis',
        'CST-3113' => 'Artificial Intelligence',
        'CS-3124' => 'Software Analysis and Design',
        'CS-3125' => 'Database System Structure',
        'CS(SK)3156' => 'Web Development (PHP)',
        'CST(SK)3157' => 'Financial Management & Accounting',
        
        // Third Year First Semester (CT)
        'CST-3131' => 'Computer Architecture and Organization I',
        'CST-3142' => 'Differential Equations and Numerical Analysis',
        'CST-3113' => 'Artificial Intelligence',
        'CT-3134' => 'Electronic Devices',
        'CT-3135' => 'Control System',
        'CT(SK)3136' => 'Linux Fundamentals and Administration',
        'CST(SK)3157' => 'Financial Management & Accounting',
        
        // Third Year Second Semester (CS)
        'CST-3211' => 'Operating Systems',
        'CST-3242' => 'Probability & Statistics',
        'CST-3213' => 'Professional Ethics',
        'CS-3224' => 'Software Quality Assurance and Testing',
        'CST-3235' => 'Computer Network I',
        'CST-3256' => 'Human Computer Interaction',
        'CST-3257' => 'Applied Database and Application (C#)',
        
        // Third Year Second Semester (CT)
        'CST-3211' => 'Operating Systems',
        'CST-3242' => 'Probability & Statistics',
        'CST-3213' => 'Professional Ethics',
        'CT-3234' => 'Computer Architecture and Organization',
        'CST-3235' => 'Computer Network I',
        'CST-3256' => 'Human Computer Interaction',
        'CST-3257' => 'Applied Database and Application (C#)',
        
        // Fourth Year First Semester (CS)
        'E-4101' => 'Business English II',
        'CST-4111' => 'Analysis of Algorithms',
        'CS-4142' => 'Operations Research',
        'CS-4113' => 'Computer Vision',
        'CS-4124' => 'Information Assurance and Security',
        'CST-4125' => 'Software Project Management',
        
        // Fourth Year First Semester (CT)
        'E-4101' => 'Business English III',
        'CST-4111' => 'Analysis of Algorithms',
        'CT-4132' => 'Digital Design',
        'CT-4133' => 'Computer Networks II',
        'CT-4134' => 'Embedded Systems',
        'CST-4125' => 'Software Project Management System',
        
        // Fourth Year Second Semester (CS)
        'CST-4211' => 'Parallel and Distributed Computing',
        'CST-4242' => 'Modeling & Simulation',
        'CS-4223' => 'Software Design & Development',
        'CS-4214' => 'Advanced Artificial Intelligence',
        'CS-4225' => 'Advanced Database System',
        'CST-4257' => 'Digital Business and E-Commerce Management',
        
        // Fourth Year Second Semester (CT)
        'CST-4211' => 'Parallel and Distributed Computing',
        'CST-4242' => 'Modeling & Simulation',
        'CT-4233' => 'Cryptography and Network Security',
        'CT-4234' => 'Embedded System Integrating IoT',
        'CT-4236' => 'Cyber Security',
        'CST-4257' => 'Digital Business and E-Commerce Management',
        
        // Fifth Year First Semester (CS)
        'E-5101' => 'English',
        'CST-5141' => 'Mathematics of Computing (V)',
        'CST-5102' => 'Distributed Systems + Advanced Networking',
        'CS-5123' => 'Information Assurance & Security',
        'CS-5114' => 'Advanced Artificial Intelligence + Natural Language Processing',
        'CS-5125' => 'Data Mining',
        
        // Fifth Year First Semester (CT)
        'E-5101' => 'English',
        'CST-5141' => 'Mathematics of Computing (V)',
        'CST-5102' => 'Distributed Systems + Advanced Networking',
        'CT-5133' => 'Fuzzy Logic Control Systems',
        'CT-5134' => 'Network Security',
        'CS-5135' => 'Image Processing & Computer Vision'
    ];

    // Query to fetch results for specific roll number
    $query = "SELECT * FROM $table_name WHERE roll_no = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $roll_no);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        // Fetch student name from students table
        $name_query = "SELECT name FROM students WHERE roll_no = ?";
        $name_stmt = mysqli_prepare($conn, $name_query);
        mysqli_stmt_bind_param($name_stmt, 's', $roll_no);
        mysqli_stmt_execute($name_stmt);
        $name_result = mysqli_stmt_get_result($name_stmt);
        $student_info = mysqli_fetch_assoc($name_result);
        $student_name = $student_info ? $student_info['name'] : '';

        // Store results for display
        $results = [];
        foreach ($row as $column => $value) {
            if ($column !== 'id' && $column !== 'roll_no' && !is_null($value)) {
                $subject_name = isset($subject_names[$column]) ? $subject_names[$column] : $column;
                $results[] = [
                    'subject_code' => $column,
                    'subject_name' => $subject_name,
                    'acus' => 3, // Default value, adjust if needed
                    'marks' => (int)$value
                ];
            }
        }
        
        // Calculate total semester based on year and current semester
        $total_semester = (($year - 1) * 2) + $semester;
        
        // Student data
        $studentData = [
            'name' => $student_name,
            'roll_no' => $roll_no,
            'degree' => 'B.C.Sc.',
            'specialization' => $course_type === 'cs' ? 'Computer Science' : ($course_type === 'ct' ? 'Computer Technology' : 'Computer Science and Technology'),
            'academic_year' => '2024-2025',
            'semester' => $total_semester
        ];
    } else {
        $_SESSION['error'] = 'No results found for the specified roll number';
        header('Location: view_results.php');
        exit;
    }
} else {
    header('Location: home.php');
    exit;
}

// Grading functions
function getLetterGrade($marks) {
    if ($marks >= 90) return 'A+';
    if ($marks >= 80) return 'A';
    if ($marks >= 75) return 'A-';
    if ($marks >= 70) return 'B+';
    if ($marks >= 65) return 'B';
    if ($marks >= 60) return 'B-';
    if ($marks >= 55) return 'C+';
    if ($marks >= 50) return 'C';
    if ($marks >= 40) return 'D';
    return 'F';
}

function getGradeScore($letterGrade) {
    switch ($letterGrade) {
        case 'A+': return 4.0;
        case 'A': return 4.0;
        case 'A-': return 3.67;
        case 'B+': return 3.33;
        case 'B': return 3.0;
        case 'B-': return 2.67;
        case 'C+': return 2.33;
        case 'C': return 2.0;
        case 'D': return 1.0;
        default: return 0.0;
    }
}

function calculateGradePoint($acus, $gradeScore) {
    return $acus * $gradeScore;
}

function calculateGPA($totalGradePoints, $totalACUs) {
    if ($totalACUs == 0) return 0;
    return $totalGradePoints / $totalACUs;
}

// Calculate totals
$totalACUs = 0;
$totalGradePoints = 0;

?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Result - UCSH</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <style>
      @media print {
        @page {
          size: A4;
          margin: 1cm;
        }
        body {
          print-color-adjust: exact;
          -webkit-print-color-adjust: exact;
        }
        .container {
          width: 100% !important;
          padding: 0 !important;
          margin: 0 !important;
        }
        table {
          font-size: 11px !important;
          width: 100% !important;
          table-layout: fixed !important;
        }
        th, td {
          padding: 4px !important;
          white-space: normal !important;
        }
        th {
          background-color: #f3f4f6 !important;
        }
        .print\:text-sm {
          font-size: 11px !important;
        }
        .print\:text-xs {
          font-size: 10px !important;
        }
        .print\:w-full {
          width: 100% !important;
        }
        .print\:break-inside-avoid {
          break-inside: avoid;
        }
      }
    </style>
  </head>
  <body>
    <div class="container mx-auto h-auto px-3 md:px-20 lg:px-32 print:px-0">
      <nav
        class="bg-gray-400/20 print:hidden border-gray-200 sticky rounded-md px-2 py-1 mt-7 md:mt-4 lg:mt-20 mx-auto w-full"
      >
        <div
          class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2"
        >
          <a
            class="flex items-center space-x-3 rtl:space-x-reverse"
            href="index.html"
          >
            <img
              src="./assets/IMG_8564.JPG"
              class="h-8 rounded-full"
              alt="Flowbite Logo"
            />
            <span
              class="self-center text-2xl font-semibold whitespace-nowrap text-black"
              >UCSH</span
            >
          </a>
          <button
            data-collapse-toggle="navbar-default"
            type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-default"
            aria-expanded="false"
          >
            <span class="sr-only">Open main menu</span>
            <svg
              class="w-5 h-5"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 17 14"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M1 1h15M1 7h15M1 13h15"
              />
            </svg>
          </button>
          <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
              class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0"
            >
              <li>
                <a
                  href="home.php"
                  class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500"
                  aria-current="page"
                  >Home</a
                >
              </li>
              <li>
                <a
                  href="#about"
                  class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                  >About</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                  >pricing</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                  >Services</a
                >
              </li>
             
             
            </ul>
          </div>
        </div>
      </nav>
      <div
        class="min-h-screen bg-white p-4 md:p-8 lg:p-12 max-w-4xl sm:min-w-full mx-auto print:block"
      >
        <div class="text-center mb-8">
          <h1 class="text-xl md:text-2xl font-bold mb-2">
            University of Computer Studies (Hpa-an)
          </h1>
          <p class="text-lg md:text-xl mb-2">2024-2025 Academic Year</p>
          <p class="text-lg md:text-xl font-semibold">Academic Record</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
          <div class="space-y-2">
            <p class="flex gap-2">
              <span class="font-semibold min-w-[140px]">Roll Number</span>
              <span>: <?php echo htmlspecialchars($studentData['roll_no']); ?></span>
            </p>
            <p class="flex gap-2">
              <span class="font-semibold min-w-[140px]">Student Name</span>
              <span>: <?php echo htmlspecialchars($studentData['name']); ?></span>
            </p>
            <p class="flex gap-2">
              <span class="font-semibold min-w-[140px]">Degree Program</span>
              <span>: <?php echo htmlspecialchars($studentData['degree']); ?></span>
            </p>
            <p class="flex gap-2">
              <span class="font-semibold min-w-[140px]">Specialization</span>
              <span>: <?php echo htmlspecialchars($studentData['specialization']); ?></span>
            </p>
          </div>
          <div class="space-y-2">
            <p class="flex gap-2">
              <span class="font-semibold min-w-[140px]">Academic Year</span>
              <span>: <?php echo htmlspecialchars($studentData['academic_year']); ?></span>
            </p>
            <p class="flex gap-2">
              <span class="font-semibold min-w-[140px]">Semester</span>
              <span>: <?php echo htmlspecialchars($studentData['semester']); ?></span>
            </p>
          </div>
        </div>

        <div class="mb-8 overflow-x-auto print:overflow-visible">
          <table class="min-w-full border-collapse border border-gray-300 print:text-sm">
            <thead>
              <tr class="bg-gray-100">
                <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 text-left print:p-1 print:text-sm">
                  No.
                </th>
                <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 text-left print:p-1 print:text-sm">
                  Subject Code
                </th>
                <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 text-left print:p-1 print:text-sm">
                  Subject Name
                </th>
                <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 text-center print:p-1 print:text-sm">
                  ACUs
                </th>
                <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 text-center print:p-1 print:text-sm">
                  Marks
                </th>
                <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 text-center print:p-1 print:text-sm">
                  Letter Grade
                </th>
                <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 text-center print:p-1 print:text-sm">
                  Grade Score
                </th>
                <th class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 text-center print:p-1 print:text-sm">
                  Grade Point
                </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($results as $index => $result): 
                $letterGrade = getLetterGrade($result['marks']);
                $gradeScore = getGradeScore($letterGrade);
                $gradePoint = calculateGradePoint($result['acus'], $gradeScore);
                
                $totalACUs += $result['acus'];
                $totalGradePoints += $gradePoint;
              ?>
                <tr>
                  <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 print:p-1 print:text-sm">
                    <?php echo $index + 1; ?>
                  </td>
                  <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 print:p-1 print:text-sm">
                    <?php echo htmlspecialchars($result['subject_code']); ?>
                  </td>
                  <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 print:p-1 print:text-sm">
                    <?php echo htmlspecialchars($result['subject_name']); ?>
                  </td>
                  <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 text-center print:p-1 print:text-sm">
                    <?php echo $result['acus']; ?>
                  </td>
                  <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 text-center print:p-1 print:text-sm">
                    <?php echo $result['marks']; ?>
                  </td>
                  <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 text-center print:p-1 print:text-sm">
                    <?php echo $letterGrade; ?>
                  </td>
                  <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 text-center print:p-1 print:text-sm">
                    <?php echo number_format($gradeScore, 2); ?>
                  </td>
                  <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 text-center print:p-1 print:text-sm">
                    <?php echo number_format($gradePoint, 2); ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 font-semibold print:p-1 print:text-sm">
                  Total Credit Units
                </td>
                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 text-center print:p-1 print:text-sm">
                  <?php echo $totalACUs; ?>
                </td>
                <td colspan="3" class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 font-semibold text-right print:p-1 print:text-sm">
                  Total Grade Points
                </td>
                <td class="border border-gray-300 px-2 py-1 md:px-4 md:py-3 text-center print:p-1 print:text-sm">
                  <?php echo number_format($totalGradePoints, 2); ?>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>

        <div class="flex justify-end mb-8 print:break-inside-avoid">
          <div class="w-48 ">
            <div class="border border-gray-300 mb-1">
              <div class="px-4 py-2 flex justify-between print:text-sm">
                <span>Semester GPA</span>
                <span><?php echo number_format(calculateGPA($totalGradePoints, $totalACUs), 2); ?></span>
              </div>
            </div>
            <div class="flex gap-2">
              <form action="view_results.php" method="POST" class="w-full">
                <input type="hidden" name="year" value="<?php echo isset($_POST['year']) ? $_POST['year'] : ''; ?>">
                <input type="hidden" name="semester" value="<?php echo isset($_POST['semester']) ? $_POST['semester'] : ''; ?>">
                <input type="hidden" name="course_type" value="<?php echo isset($_POST['course_type']) ? $_POST['course_type'] : ''; ?>">
                <button type="submit" class="border bg-gray-500 cursor-pointer print:hidden w-full">
                  <div class="px-4 py-2 flex justify-center items-center">
                    <span class="text-white">Back</span>
                  </div>
                </button>
              </form>
              <div class="border bg-black cursor-pointer print:hidden w-full" id="printbtn">
                <div class="px-4 py-2 flex justify-center items-center">
                  <span class="text-white">Print</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="mb-8 print:hidden">
          <h2 class="font-bold mb-4">GRADING SCALE</h2>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="space-y-2">
              <p class="flex justify-between">
                <span>>=90</span>
                <span>A+ (4.0)</span>
              </p>
              <p class="flex justify-between">
                <span>70-74</span>
                <span>B+ (3.33)</span>
              </p>
              <p class="flex justify-between">
                <span>55-59</span>
                <span>C+ (2.33)</span>
              </p>
            </div>
            <div class="space-y-2">
              <p class="flex justify-between">
                <span>80-89</span>
                <span>A (4.0)</span>
              </p>
              <p class="flex justify-between">
                <span>65-69</span>
                <span>B (3.0)</span>
              </p>
              <p class="flex justify-between">
                <span>50-54</span>
                <span>C (2.0)</span>
              </p>
            </div>
            <div class="space-y-2">
              <p class="flex justify-between">
                <span>75-79</span>
                <span>A- (3.67)</span>
              </p>
              <p class="flex justify-between">
                <span>60-64</span>
                <span>B- (2.67)</span>
              </p>
              <p class="flex justify-between">
                <span>40-49</span>
                <span>D (1.0)</span>
              </p>
              <p class="flex justify-between">
                <span>0-39</span>
                <span>F (0.0)</span>
              </p>
            </div>
          </div>
        </div>

        <div class="mb-12">
          <p>ISSUE DATE : <?php echo date('d-M-Y'); ?></p>
        </div>

        <div class="text-center">
          <p class="font-bold">REGISTRAR</p>
          <p>Academic Department</p>
          <p>University of Computer Studies (Hpa-an)</p>
        </div>
      </div>
      <script>
        const printbtn = document.querySelector("#printbtn");

        const printHandler = () => {
          window.print();
          //   console.log("hi");
        };
        printbtn.addEventListener("click", printHandler);
      </script>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  </body>
</html>
