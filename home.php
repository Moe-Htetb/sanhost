<?php
require_once 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/svg+xml" href="/vite.svg" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UCSH - University of Computer Studies (Hpa-An)</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <link
    href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css"
    rel="stylesheet" />
</head>

<body>
  <div id="app" class="container mx-auto h-auto px-3 md:px-20 lg:px-32">


    <!-- navigation -->

    <nav
      class="bg-gray-300 sticky top-3 z-40 border-gray-200 h-auto rounded-md px-2 py-1 mt-5 md:mt-4 lg:mt-7 mx-auto w-full">
      <div
        class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2">
        <a
          class="flex items-center space-x-3 rtl:space-x-reverse"
          href="home.php">
          <img
            src="./assets/IMG_8564.JPG"
            class="h-8 rounded-full"
            alt="Flowbite Logo" />
          <span
            class="self-center text-2xl font-semibold whitespace-nowrap text-black">UCSH</span>
        </a>
        <button
          data-collapse-toggle="navbar-default"
          type="button"
          class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
          aria-controls="navbar-default"
          aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg
            class="w-5 h-5"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 17 14">
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M1 1h15M1 7h15M1 13h15" />
          </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
          <ul
            class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
            <li>
              <a
                href="home.php"
                class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500"
                aria-current="page">Home</a>
            </li>
            <li>
              <a
                href="#about"
                class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About</a>
            </li>
            <li>
              <a
                href="#event"
                class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Events</a>
            </li>
           
            <li>
              <?php if (isLoggedIn()): ?>
                <div class="flex items-center gap-2">

                  <a href="logout.php" class="block px-4 py-1 text-sm text-white bg-black rounded-md hover:bg-gray-800">Logout</a>
                </div>
              <?php else: ?>
                <a href="login.php" class="block px-4 py-1 text-sm text-white bg-black rounded-md hover:bg-gray-800">Sign In</a>
              <?php endif; ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- nav end--------- -->


    <!-- sign In modal end  -->


    <!-- result modal -->
    <div
      id="result-modal"
      tabindex="-1"
      aria-hidden="true"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm">
          <!-- Modal header -->
          <div
            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
            <h3 class="text-xl font-semibold text-gray-900">
              View Your Results
            </h3>
            <button
              type="button"
              class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
              data-modal-hide="result-modal">
              <svg
                class="w-3 h-3"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 14 14">
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <!-- Modal body -->
          <div class="p-4 md:p-5">
            <?php if (!isLoggedIn()): ?>
              <div class="text-center py-4">
                <p class="text-gray-600 mb-4">Please log in to view your results.</p>
                <a href="login.php" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                  Sign In
                </a>
              </div>
            <?php elseif (!isStudent()): ?>
              <div class="text-center py-4">
                <p class="text-gray-600">Only students can view results.</p>
              </div>
            <?php else: ?>
              <?php if (isset($_SESSION['error'])): ?>
                <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50">
                  <?php 
                    echo htmlspecialchars($_SESSION['error']);
                    unset($_SESSION['error']);
                  ?>
                </div>
              <?php endif; ?>
              
              <form id="result-form" action="view_results.php" method="POST">
                <!-- Course Type Field -->
                <div class="mb-4">
                  <label for="course_type" class="block text-sm font-medium text-gray-700">Course</label>
                  <select id="course_type" name="course_type" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="cst">Computer Science and Technology (CST)</option>
                    <option value="cs" class="hidden cs-option">Computer Science (CS)</option>
                    <option value="ct" class="hidden ct-option">Computer Technology (CT)</option>
                  </select>
                </div>

                <!-- Year Field -->
                <div class="mb-4">
                  <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                  <select id="year" name="year" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="" disabled selected>Select Year</option>
                    <option value="1">First Year</option>
                    <option value="2">Second Year</option>
                    <option value="3">Third Year</option>
                    <option value="4">Fourth Year</option>
                    <option value="5">Fifth Year</option>
                  </select>
                </div>

                <!-- Semester Field -->
                <div class="mb-6">
                  <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                  <select id="semester" name="semester" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="" disabled selected>Select Semester</option>
                    <option value="1">First Semester</option>
                    <option value="2" class="non-fifth-year">Second Semester</option>
                  </select>
                </div>

                <!-- Submit Button -->
                <div>
                  <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    View Results
                  </button>
                </div>
              </form>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>


    <!-- first section  -->
    <section class="sm:mt-5 md:mt-20 min-h-[400px] md:min-h-[600px]">
      <div class="grid grid-cols-1 md:grid-cols-2 h-full">
        <div class="col-span-1 mt-10 pl-5">
          <div class="p-3 flex flex-col gap-5 justify-evenly">
            <h3 class="text-xl md:text-3xl font-bold">
              University of Computer Studies(Hpa-An)
            </h3>
            <p class="text-gray-500 w-full my-4">
              View your exam result!
            </p>

            <ul class="space-y-2 text-left text-gray-500 dark:text-gray-400">
              <li class="flex items-center space-x-3 rtl:space-x-reverse">
                <svg
                  class="shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 16 12">
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M1 5.917 5.724 10.5 15 1.5" />
                </svg>
                <span>Easy Login</span>
              </li>
              <li class="flex items-center space-x-3 rtl:space-x-reverse">
                <svg
                  class="shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 16 12">
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M1 5.917 5.724 10.5 15 1.5" />
                </svg>
                <span>Free</span>
              </li>
              <li class="flex items-center space-x-3 rtl:space-x-reverse">
                <svg
                  class="shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 16 12">
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M1 5.917 5.724 10.5 15 1.5" />
                </svg>
                <span>
                  Easy to use
                </span>
              </li>

              <li class="flex items-center space-x-3 rtl:space-x-reverse">
                <svg
                  class="shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 16 12">
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M1 5.917 5.724 10.5 15 1.5" />
                </svg>
                <span>Free updates:
                  </span>
              </li>
            </ul>

            <?php if (isLoggedIn() && isStudent()): ?>
              <button
                type="button"
                data-modal-target="result-modal"
                data-modal-toggle="result-modal"
                class="bg-black cursor-pointer text-white w-fit px-6 py-2 md:px-10 md:py-3 mt-4 rounded-sm">
                View My Results
              </button>
            <?php else: ?>
              <button
                type="button"
                data-modal-target="result-modal"
                data-modal-toggle="result-modal"
                class="bg-black cursor-pointer text-white w-fit px-6 py-2 md:px-10 md:py-3 mt-4 rounded-sm">
                Get Started
              </button>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-span-1">
          <img
            src="./assets/IMG_0069.JPG"
            alt=""
            class="w-full h-full overflow-hidden rounded-md" />
        </div>
      </div>
    </section>
    <!-- first section  end ------ -->

    <!-- second section -->
    <section class="mt-10">
      <h2 class="text-2xl font-bold my-2">Some Place of UCSH</h2>
      <div class="grid grid-cols-1 min-h-[650px]">
        <div
          id="default-carousel"
          class="relative w-full h-full"
          data-carousel="slide">
          <!-- Carousel wrapper -->
          <div class="relative rounded-md h-full overflow-hidden">
            <!-- Item 1 -->
            <div
              class="hidden duration-700 ease-in-out h-full"
              data-carousel-item>
              <img
                src="./assets/IMG_0070.JPG"
                class="absolute block w-full h-full object-cover"
                alt="..." />
            </div>
            <!-- Item 2 -->
            <div
              class="hidden duration-700 ease-in-out h-full"
              data-carousel-item>
              <img
                src="./assets/IMG_0074.JPG"
                class="absolute block w-full h-full object-cover"
                alt="..." />
            </div>
            <!-- Item 3 -->
            <div
              class="hidden duration-700 ease-in-out h-full"
              data-carousel-item>
              <img
                src="./assets/3.png"
                class="absolute block w-full h-full object-cover"
                alt="..." />
            </div>
            <!-- Item 4 -->
            <div
              class="hidden duration-700 ease-in-out h-full"
              data-carousel-item>
              <img
                src="./assets/IMG_0073.JPG"
                class="absolute block w-full h-full object-cover"
                alt="..." />
            </div>
            <!-- Item 5 -->
            <div
              class="hidden duration-700 ease-in-out h-full"
              data-carousel-item>
              <img
                src="./assets/IMG_0076.JPG"
                class="absolute block w-full h-full object-cover"
                alt="..." />
            </div>
          </div>
          <!-- Slider indicators -->
          <div
            class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button
              type="button"
              class="w-3 h-3 rounded-full"
              aria-current="true"
              aria-label="Slide 1"
              data-carousel-slide-to="0"></button>
            <button
              type="button"
              class="w-3 h-3 rounded-full"
              aria-current="false"
              aria-label="Slide 2"
              data-carousel-slide-to="1"></button>
            <button
              type="button"
              class="w-3 h-3 rounded-full"
              aria-current="false"
              aria-label="Slide 3"
              data-carousel-slide-to="2"></button>
            <button
              type="button"
              class="w-3 h-3 rounded-full"
              aria-current="false"
              aria-label="Slide 4"
              data-carousel-slide-to="3"></button>
            <button
              type="button"
              class="w-3 h-3 rounded-full"
              aria-current="false"
              aria-label="Slide 5"
              data-carousel-slide-to="4"></button>
          </div>
          <!-- Slider controls -->
          <button
            type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
              class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
              <svg
                class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 6 10">
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M5 1 1 5l4 4" />
              </svg>
              <span class="sr-only">Previous</span>
            </span>
          </button>
          <button
            type="button"
            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
              class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
              <svg
                class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 6 10">
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 9 4-4-4-4" />
              </svg>
              <span class="sr-only">Next</span>
            </span>
          </button>
        </div>
      </div>
    </section>

    <!-- about section -->
    <section class="bg-gray-100 mt-10 p-10 rounded-md about" id="about">
      <div class="max-w-7xl mx-auto">
        <!-- Heading -->
        <h2 class="text-4xl font-light mb-8 text-center">
          <span class="text-gray-800">About </span>
          <span class="text-amber-600 font-bold">Our System</span>
        </h2>

        <!-- Grid Container -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <!-- End-to-End Solutions -->
          <div class="bg-white rounded-3xl p-8 shadow-md">
            <h3 class="text-xl text-gray-800 font-medium mb-4">
              Easy Login
            </h3>
            <p class="text-gray-600">
              Students can login with their edu mail easily.
            </p>
          </div>

          <!-- After-Sales Support -->
          <div class="bg-blue-100 rounded-3xl p-8 shadow-md">
            <h3 class="text-xl text-gray-800 font-medium mb-4">
              Free To Use
            </h3>
            <p class="text-gray-600">
              Our system is free to use and no need to be paid.
            </p>
          </div>

          <!-- No Variety Restrictions -->
          <div class="bg-amber-100 rounded-3xl p-8 shadow-md">
            <h3 class="text-xl text-black font-medium mb-4">
              Easy To Use
            </h3>
            <p class="text-cream/90">
              We're providing the user friendly interface for the users to use easily.
            </p>
          </div>

          <!-- Superior Quality -->
          <div
            class="md:col-span-2 bg-gray-500 rounded-3xl p-8 shadow-md relative overflow-hidden">
            <div class="relative z-10">
              <h3 class="text-2xl text-white font-medium mb-4">
                Free Update
              </h3>
              <p class="text-gray-300">
                We'll update the exam result for each semester for free!
              </p>
            </div>
            <div class="absolute inset-0 bg-black/40"></div>
            <img
              src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Screenshot%202025-02-21%20at%207.50.25%E2%80%AFPM-X1DfFIoroayvjc3C9OdsJpxR07KXLO.png"
              alt="Modern dining setup"
              class="absolute inset-0 w-full h-full object-cover -z-10" />
          </div>
          <!-- Bespoke Furniture -->
          <div class="bg-brown-dark rounded-3xl p-8 shadow-md">
            <h3 class="text-xl text-black font-medium mb-4">
              View your exam result
            </h3>
            <p class="text-cream/90">
              Users can view their exam result in the most simple way.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Event section -->
    <section id="event" class="h-[400px] mt-10">
      <h2 class="text-2xl font-bold my-2">Events In UCSH</h2>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <div
          class="grid-cols-1 border min-h-[300px] border-gray-400 overflow-hidden rounded-md flex flex-col gap-3">
          <div>
            <img
              src="./assets/IMG_0368.JPG"
              class="object-bottom"
              alt="" />
          </div>

          <div class="px-3">
            <p class="text-sm font-semibold line-clamp-3">
              We're celebrating football matches in every semester.
            </p>
          </div>
          <div class="flex justify-between px-3 mt-auto py-1">
            <div class="">
              <p class="text-sm font-semibold">Football</p>
            </div>
            <div class="text-sm font-semibold">Feb 7,2025</div>
          </div>
        </div>

        <div
          class="grid-cols-1 border min-h-[300px] border-gray-400 overflow-hidden rounded-md flex flex-col gap-3">
          <div>
            <img
              src="./assets/IMG_0369.JPG"
              class="object-cover"
              alt="" />
          </div>

          <div class="px-3">
            <p class="text-sm font-semibold line-clamp-3">
              Join us at the University Water Festival for a day of fun, water games.
            </p>
          </div>
          <div class="flex justify-between px-3 mt-auto py-1">
            <div class="">
              <p class="text-sm font-semibold">Water Festival</p>
            </div>
            <div class="text-sm font-semibold">May 7,2024</div>
          </div>
        </div>
        <div
          class="grid-cols-1 border min-h-[300px] border-gray-400 overflow-hidden rounded-md flex flex-col gap-3">
          <div>
            <img
              src="./assets/IMG_0370.JPG"
              class="object-cover"
              alt="" />
          </div>

          <div class="px-3">
            <p class="text-sm font-semibold line-clamp-3">
              Come join us for the Junior Welcome! It's a day full of fun activities, new friendships.
            </p>
          </div>
          <div class="flex justify-between px-3 mt-auto py-1">
            <div class="">
              <p class="text-sm font-semibold">Welcome</p>
            </div>
            <div class="text-sm font-semibold">Decem 21,2023</div>
          </div>
        </div>
        <div
          class="grid-cols-1 border min-h-[300px] border-gray-400 overflow-hidden rounded-md flex flex-col gap-3">
          <div>
            <img
              src="./assets/IMG_0372.JPG"
              class="object-cover"
              alt="" />
          </div>

          <div class="px-3">
            <p class="text-sm font-semibold line-clamp-3">
              Come join us for HTAmanal! It's a day of celebration, culture, and unforgettable experiences.
            </p>
          </div>
          <div class="flex justify-between px-3 mt-auto py-1">
            <div class="">
              <p class="text-sm font-semibold">Hta Ma Nal</p>
            </div>
            <div class="text-sm font-semibold">May 17,2025</div>
          </div>
        </div>
      </div>
    </section>

    <footer class="bg-gray-400/20 rounded-lg shadow-sm">
      <div class="w-full mx-auto p-4 md:py-8">
        <div
          class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <a
            href="home.php"
            class="flex items-center space-x-3 rtl:space-x-reverse">
            <img 
              src="./assets/IMG_8564.JPG"
              class="h-8 w-8 rounded-full"
              alt="UCSH Logo" />
            <span
              class="self-center text-xl sm:text-2xl font-semibold whitespace-nowrap">UCSH</span>
          </a>
          <ul
            class="flex flex-wrap items-center text-sm font-medium gap-4 sm:gap-6">
            <li>
              <a href="#" class="hover:underline">About</a>
            </li>
            <li>
              <a href="#" class="hover:underline">Privacy Policy</a>
            </li>
            <li>
              <a href="#" class="hover:underline">Licensing</a>
            </li>
            <li>
              <a href="#" class="hover:underline">Contact</a>
            </li>
          </ul>
        </div>
        <hr
          class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div class="text-center">
          <span class="block text-sm text-gray-500 dark:text-gray-400">© 2024
            <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.</span>
        </div>
      </div>
    </footer>
  </div>
  <!-- <script type="module" src="/src/main.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize modals
      const resultModal = document.getElementById('result-modal');
      if (resultModal) {
        const modal = new Modal(resultModal, {
          placement: 'center',
          backdrop: 'dynamic',
          onShow: () => {
            console.log('Result modal shown');
          },
          onHide: () => {
            console.log('Result modal hidden');
          }
        });

        // Add click event listeners to all buttons that should open the modal
        const modalToggles = document.querySelectorAll('[data-modal-toggle="result-modal"]');
        modalToggles.forEach(toggle => {
          toggle.addEventListener('click', () => {
            modal.show();
          });
        });

        // Add click event listeners to all buttons that should close the modal
        const modalCloses = document.querySelectorAll('[data-modal-hide="result-modal"]');
        modalCloses.forEach(close => {
          close.addEventListener('click', () => {
            modal.hide();
          });
        });

        // Add form submit handler for unauthorized users
        const resultForm = document.getElementById('result-form');
        if (resultForm) {
          resultForm.addEventListener('submit', function(e) {
            if (!<?php echo isLoggedIn() && isStudent() ? 'true' : 'false' ?>) {
              e.preventDefault();
              alert('Please log in as a student to view results');
              window.location.href = 'login.php';
            }
          });
        }
      }

      // Form toggle functionality
      const adminBtn = document.querySelector("#adminBtn");
      const adminInput = document.querySelector("#adminInput");
      const userBtn = document.querySelector("#userBtn");
      const userInput = document.querySelector("#userInput");
      const userLoginBtn = document.querySelector("#userLoginBtn");
      const adminLoginBtn = document.querySelector("#adminLoginBtn");
      const userTypeInput = document.querySelector("#userType");

      if (userBtn && adminBtn) {
        userBtn.addEventListener("click", () => {
          userInput.classList.remove("hidden");
          adminInput.classList.add("hidden");
          adminLoginBtn.classList.add("hidden");
          userLoginBtn.classList.remove("hidden");
          userTypeInput.value = "user";
        });

        adminBtn.addEventListener("click", () => {
          adminInput.classList.remove("hidden");
          userInput.classList.add("hidden");
          userLoginBtn.classList.add("hidden");
          adminLoginBtn.classList.remove("hidden");
          userTypeInput.value = "admin";
        });

        // Set default user type
        if (userTypeInput) {
          userTypeInput.value = "user";
        }

        // Show user login form by default
        if (userInput && adminInput) {
          userInput.classList.remove("hidden");
          adminInput.classList.add("hidden");
        }

        if (userLoginBtn && adminLoginBtn) {
          userLoginBtn.classList.remove("hidden");
          adminLoginBtn.classList.add("hidden");
        }
      }

      // Add year change handler for course type options
      const yearSelect = document.getElementById('year');
      const semesterSelect = document.getElementById('semester');
      const courseTypeSelect = document.getElementById('course_type');
      const csOptions = document.querySelectorAll('.cs-option');
      const ctOptions = document.querySelectorAll('.ct-option');
      const cstOption = courseTypeSelect.querySelector('option[value="cst"]');
      const secondSemOption = semesterSelect.querySelector('.non-fifth-year');

      function updateCourseOptions() {
        const year = parseInt(yearSelect.value);
        const semester = parseInt(semesterSelect.value);

        // Handle fifth year semester options
        if (year === 5) {
          secondSemOption.classList.add('hidden');
          if (semester === 2) {
            semesterSelect.value = "1";
          }
        } else {
          secondSemOption.classList.remove('hidden');
        }

        // Hide all options first
        csOptions.forEach(opt => opt.classList.add('hidden'));
        ctOptions.forEach(opt => opt.classList.add('hidden'));
        cstOption.classList.add('hidden');

        // Reset selection
        courseTypeSelect.value = "";

        if (year === 1 || (year === 2 && semester === 1)) {
          // First year and Second year first semester: Show only CST
          cstOption.classList.remove('hidden');
          courseTypeSelect.value = "cst";
        } else if (year === 2 && semester === 2) {
          // Second year second semester: Show CS and CT
          csOptions.forEach(opt => opt.classList.remove('hidden'));
          ctOptions.forEach(opt => opt.classList.remove('hidden'));
          courseTypeSelect.value = "cs"; // Default to CS
        } else if (year >= 3) {
          // Third year and above: Show CS and CT
          csOptions.forEach(opt => opt.classList.remove('hidden'));
          ctOptions.forEach(opt => opt.classList.remove('hidden'));
          courseTypeSelect.value = "cs"; // Default to CS
        }
      }

      yearSelect.addEventListener('change', updateCourseOptions);
      semesterSelect.addEventListener('change', updateCourseOptions);

      // Initial update
      if (yearSelect.value) {
        updateCourseOptions();
      }
    });
  </script>
</body>

</html>