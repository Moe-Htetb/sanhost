<?php
function getDBConnection()
{
  static $conn = null;

  if ($conn === null) {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db   = 'resultsystem';
    
    // Try to connect without socket first
    $conn = new mysqli($host, $user, $pass, $db);
    
    // If connection fails, try with socket
    if ($conn->connect_error) {
      $socket = '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock';
      $conn = new mysqli($host, $user, $pass, $db, null, $socket);
      
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
    }
    
    $conn->set_charset("utf8mb4");
  }

  return $conn;
}

// Then anywhere you need the connection:
$conn = getDBConnection();

// Start session securely
session_start([
  'cookie_httponly' => true,
  'cookie_secure' => isset($_SERVER['HTTPS']),
  'use_strict_mode' => true
]);

// Authentication Functions
function isLoggedIn()
{
  return isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
}

function logout()
{
  $_SESSION = [];
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
      session_name(),
      '',
      time() - 42000,
      $params["path"],
      $params["domain"],
      $params["secure"],
      $params["httponly"]
    );
  }
  session_destroy();
}

function validateEmail($email, $domain)
{
  $email = trim($email);
  if (empty($email)) return "Email is required";
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return "Invalid email format";
  
  // Replace str_ends_with with compatible code for older PHP versions
  if (substr($email, -strlen($domain)) !== $domain) return "Email must end with $domain";
  return null;
}

// Handle logout
if (isset($_GET['logout'])) {
  logout();
  header("Location: home_copy.php");
  exit();
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $domain = '@ucshpaan.edu.mm';
  $errors = [];

  if (isset($_POST['userLogin'])) {
    // Student login validation
    $emailError = validateEmail($_POST['userEmail'] ?? '', $domain);
    if ($emailError) $errors[] = $emailError;

    $rollNo = trim($_POST['rollNo'] ?? '');
    if (empty($rollNo)) $errors[] = 'Roll number is required';

    if (empty($errors)) {
      $stmt = $conn->prepare("SELECT id FROM students WHERE email = ? AND roll_no = ?");
      $stmt->bind_param("ss", $_POST['userEmail'], $rollNo);
      $stmt->execute();

      if ($stmt->get_result()->num_rows > 0) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_email'] = $_POST['userEmail'];
        $_SESSION['user_type'] = 'user';
        $_SESSION['roll_no'] = $rollNo;
        header("Location: home_copy.php");
        exit();
      } else {
        $errors[] = 'Invalid email or roll number';
      }
    }
  } elseif (isset($_POST['adminLogin'])) {
    // Admin login validation
    $emailError = validateEmail($_POST['adminEmail'] ?? '', $domain);
    if ($emailError) $errors[] = $emailError;

    $password = trim($_POST['password'] ?? '');
    if (empty($password)) $errors[] = 'Password is required';

    if (empty($errors)) {
      // NOTE: In production, use password_hash() and password_verify()
      $stmt = $conn->prepare("SELECT id FROM admin WHERE email = ? AND password = ?");
      $stmt->bind_param("ss", $_POST['adminEmail'], $password);
      $stmt->execute();

      if ($stmt->get_result()->num_rows > 0) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_email'] = $_POST['adminEmail'];
        $_SESSION['user_type'] = 'admin';
        header("Location: student_list.php");
        exit();
      } else {
        $errors[] = 'Invalid email or password';
      }
    }
  }

  // Display errors
  if (!empty($errors)) {
    echo "<script>alert('" . implode("\\n", $errors) . "');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/svg+xml" href="/vite.svg" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UCSH Student Portal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body>
  <div id="app" class="container mx-auto h-auto px-3 md:px-20 lg:px-32">
    <!-- navigation -->
    <nav class="bg-gray-300 sticky top-3 z-40 border-gray-200 h-auto rounded-md px-2 py-1 mt-5 md:mt-4 lg:mt-7 mx-auto w-full">
      <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2">
        <a class="flex items-center space-x-3 rtl:space-x-reverse" href="index.html">
          <img src="./assets/IMG_8564.JPG" class="h-8 rounded-full" alt="UCSH Logo" />
          <span class="self-center text-2xl font-semibold whitespace-nowrap text-black">UCSH</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
          </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
          <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
            <li>
              <a href="index.html" class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0" aria-current="page">Home</a>
            </li>
            <li>
              <a href="#" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">About</a>
            </li>
            <li>
              <a href="#event" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Events</a>
            </li>
            <li>
              <?php if (isLoggedIn()): ?>
                <?php if ($_SESSION['user_type'] === 'user'): ?>
                  <a data-modal-target="result-modal" data-modal-toggle="result-modal" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 cursor-pointer">Results</a>
                <?php endif; ?>
                <a href="?logout=1" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Logout</a>
              <?php else: ?>
                <a data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 cursor-pointer">Sign In</a>
              <?php endif; ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- nav end -->

    <!-- Sign In modal -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm">
          <!-- Modal header -->
          <div class="flex flex-col">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
              <h3 class="text-xl font-semibold text-gray-900">
                Sign in to our platform
              </h3>
              <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="authentication-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
              </button>
            </div>
            <div class="flex justify-evenly items-center bg-gray-100">
              <button type="button" class="text-gray-700 font-medium text-sm rounded-md py-2 px-4 cursor-pointer active-tab" id="userBtn">
                Student Login
              </button>
              <button type="button" class="text-gray-700 font-medium text-sm rounded-md px-4 py-2 cursor-pointer" id="adminBtn">
                Admin Login
              </button>
            </div>
          </div>
          <!-- Modal body -->
          <div class="p-4 md:p-5">
            <form class="space-y-4" action="home_copy.php" method="POST">
              <!-- User Email (shown by default) -->
              <div id="userEmailField">
                <label for="userEmail" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                <input type="email" name="userEmail" id="userEmail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@ucshpaan.edu.mm" required />
              </div>

              <!-- Admin Email (hidden by default) -->
              <div id="adminEmailField" class="hidden">
                <label for="adminEmail" class="block mb-2 text-sm font-medium text-gray-900">Admin email</label>
                <input type="email" name="adminEmail" id="adminEmail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="admin@ucshpaan.edu.mm" required />
              </div>

              <!-- User Input (Roll Number) -->
              <div id="userInput">
                <label for="rollNo" class="block mb-2 text-sm font-medium text-gray-900">Your Roll number</label>
                <input type="text" name="rollNo" id="rollNo" placeholder="Enter your roll number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
              </div>

              <!-- Admin Input (Password) -->
              <div id="adminInput" class="hidden">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Your Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
              </div>

              <!-- Submit Buttons -->
              <button type="submit" name="userLogin" id="userLoginBtn" class="w-full mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Login as Student
              </button>
              <button type="submit" name="adminLogin" id="adminLoginBtn" class="w-full mt-2 hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Login as Admin
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- sign In modal end -->

    <!-- result modal -->
    <div id="result-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm">
          <!-- Modal header -->
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
            <h3 class="text-xl font-semibold text-gray-900">
              View Your Results
            </h3>
            <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="result-modal">
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="p-4 md:p-5">
            <form id="result-form" action="fetch_results.php" method="POST">
              <!-- Hidden fields for student identification -->
              <input type="hidden" name="email" value="<?php echo isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : ''; ?>">
              <input type="hidden" name="roll_no" value="<?php echo isset($_SESSION['roll_no']) ? htmlspecialchars($_SESSION['roll_no']) : ''; ?>">
              
              <!-- Year Field -->
              <div class="mb-4">
                <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                <select id="year" name="year" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                  <option value="" disabled selected>Select Year</option>
                  <option value="1">1st Year</option>
                  <option value="2">2nd Year</option>
                  <option value="3">3rd Year</option>
                  <option value="4">4th Year</option>
                  <option value="5">5th Year</option>
                </select>
              </div>

              <!-- Semester Field -->
              <div class="mb-6">
                <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                <select id="semester" name="semester" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                  <option value="" disabled selected>Select Semester</option>
                  <option value="1">1st Semester</option>
                  <option value="2">2nd Semester</option>
                </select>
              </div>

              <!-- Submit Button -->
              <div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                  View Results
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script>
    // Toggle between user and admin login forms
    document.getElementById('userBtn').addEventListener('click', function() {
      document.getElementById('userEmailField').classList.remove('hidden');
      document.getElementById('userInput').classList.remove('hidden');
      document.getElementById('userLoginBtn').classList.remove('hidden');

      document.getElementById('adminEmailField').classList.add('hidden');
      document.getElementById('adminInput').classList.add('hidden');
      document.getElementById('adminLoginBtn').classList.add('hidden');

      this.classList.add('active-tab');
      document.getElementById('adminBtn').classList.remove('active-tab');
    });

    document.getElementById('adminBtn').addEventListener('click', function() {
      document.getElementById('adminEmailField').classList.remove('hidden');
      document.getElementById('adminInput').classList.remove('hidden');
      document.getElementById('adminLoginBtn').classList.remove('hidden');

      document.getElementById('userEmailField').classList.add('hidden');
      document.getElementById('userInput').classList.add('hidden');
      document.getElementById('userLoginBtn').classList.add('hidden');

      this.classList.add('active-tab');
      document.getElementById('userBtn').classList.remove('active-tab');
    });

    // Add active tab styling
    const activeTabStyle = 'border-b-2 border-blue-500 text-blue-600';
    document.querySelectorAll('#userBtn, #adminBtn').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('#userBtn, #adminBtn').forEach(b => b.classList.remove(...activeTabStyle.split(' ')));
        this.classList.add(...activeTabStyle.split(' '));
      });
    });
  </script>
</body>

</html>