<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {"50":"#eff6ff","100":"#dbeafe","200":"#bfdbfe","300":"#93c5fd","400":"#60a5fa","500":"#3b82f6","600":"#2563eb","700":"#1d4ed8","800":"#1e40af","900":"#1e3a8a","950":"#172554"}
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link
        href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css"
        rel="stylesheet" />
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


<body>

    <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <img class="w-10 h-10 " src="./IMG_8564.JPG">
                           
                        </img>
                        <span class="ms-3">UCSH Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="./student_list.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                      
                        <i class="fa-solid fa-graduation-cap w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white "></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Students</span>
                    </a>
                </li>

                <li>
                    <a href="./admin_list.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i class="fa-solid fa-user-shield w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                      
                        <span class="flex-1 ms-3 whitespace-nowrap">Admins</span>
                    </a>
                </li>

                <li>
                    <button
                        type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-example"
                        data-collapse-toggle="dropdown-example">
                        <i class="fa-solid fa-database w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white "></i>
                        <span
                            class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">
                            Add Result</span>
                        <svg
                            class="w-3 h-3"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 10 6">
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="hidden pl-6">
                        <!-- First Yeat -->
                        <li>
                            <button
                                type="button"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-1st"
                                data-collapse-toggle="dropdown-1st">
                                <span
                                    class="flex-1 text-sm ms-4 text-left rtl:text-right whitespace-nowrap">
                                    First Year</span>
                                <svg
                                    class="w-3 h-3"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 10 6">
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul id="dropdown-1st" class="hidden py-2 space-y-2">
                                <li>
                                    <a
                                        href="./first1sem.php"
                                        class="flex items-center w-full p-2 text-gray-900 text-sm transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">First Semester CST</a>
                                </li>

                                <li>
                                    <a
                                        href="./first2sem.php"
                                        class="flex items-center w-full p-2 text-gray-900 text-sm transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Seocnd Semester CST</a>
                                </li>
                            </ul>
                        </li>

                        <!-- Second Year -->
                        <li>
                            <button
                                type="button"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-2nd"
                                data-collapse-toggle="dropdown-2nd">
                                <span
                                    class="flex-1 text-sm ms-4 text-left rtl:text-right whitespace-nowrap">
                                    Second Year</span>
                                <svg
                                    class="w-3 h-3"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 10 6">
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul id="dropdown-2nd" class="hidden py-2 space-y-2">
                                <li>
                                    <a
                                        href="second1sem_cst.php"
                                        class="flex items-center w-full p-2 text-gray-900 text-sm transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">First Semester CST</a>
                                </li>

                                <li>
                                    <a
                                        href="second2sem_cs.php"
                                        class="flex items-center w-full p-2 text-gray-900 text-sm transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Seocnd Semester CS</a>
                                </li>
                                <li>
                                    <a
                                        href="second2sem_ct.php"
                                        class="flex items-center w-full p-2 text-gray-900 text-sm transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Seocnd Semester CT</a>
                                </li>
                            </ul>
                        </li>

                        <!-- Third Year -->
                        <li>
                            <button
                                type="button"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-3rd"
                                data-collapse-toggle="dropdown-3rd">
                                <span
                                    class="flex-1 text-sm ms-4 text-left rtl:text-right whitespace-nowrap">
                                    Third Year</span>
                                <svg
                                    class="w-3 h-3"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 10 6">
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul id="dropdown-3rd" class="hidden py-2 space-y-2">
                                <li>
                                    <a
                                        href="./third1sem_cs.php"
                                        class="flex items-center w-full p-2 text-gray-900 text-sm transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">First Semester CS</a>
                                </li>
                                <li>
                                    <a
                                        href="./third1sem_ct.php"
                                        class="flex items-center w-full p-2 text-gray-900 text-sm transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">First Semester CT</a>
                                </li>

                                <li>
                                    <a
                                        href="./third2sem_cs.php"
                                        class="flex items-center w-full p-2 text-gray-900 text-sm transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Seocnd Semester CS</a>
                                </li>
                                <li>
                                    <a
                                        href="./third2sem_ct.php"
                                        class="flex items-center w-full p-2 text-gray-900 text-sm transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Seocnd Semester CT</a>
                                </li>
                            </ul>
                        </li>

                        <!-- Fourth Year -->
                        <li>
                            <button
                                type="button"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-4th"
                                data-collapse-toggle="dropdown-4th">
                                <span
                                    class="flex-1 text-sm ms-4 text-left rtl:text-right whitespace-nowrap">
                                    Fourth Year</span>
                                <svg
                                    class="w-3 h-3"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 10 6">
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul id="dropdown-4th" class="hidden py-2 space-y-2">
                                <li>
                                    <a
                                        href="./fourth1sem_cs.php"
                                        class="flex items-center w-full p-2 text-gray-900 text-sm transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">First Semester CS</a>
                                </li>
                                <li>
                                    <a
                                        href="./fourth1sem_ct.php"
                                        class="flex items-center w-full p-2 text-gray-900 text-sm transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">First Semester CT</a>
                                </li>

                                <li>
                                    <a
                                        href="./fourth2sem_cs.php"
                                        class="flex items-center w-full p-2 text-gray-900 text-sm transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Seocnd Semester CS</a>
                                </li>
                                <li>
                                    <a
                                        href="./fourth2sem_ct.php"
                                        class="flex items-center w-full p-2 text-gray-900 text-sm transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Seocnd Semester CT</a>
                                </li>
                            </ul>
                        </li>

                        <!-- First Yeat -->
                        <li>
                            <button
                                type="button"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-5th"
                                data-collapse-toggle="dropdown-5th">
                                <span
                                    class="flex-1 text-sm ms-4 text-left rtl:text-right whitespace-nowrap">
                                    Fifth Year</span>
                                <svg
                                    class="w-3 h-3"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 10 6">
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul id="dropdown-5th" class="hidden py-2 space-y-2">
                                <li>
                                    <a
                                        href="./fifth1sem_cs.php"
                                        class="flex items-center w-full p-2 text-gray-900 text-sm transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">First Semester CS</a>
                                </li>
                                <li>
                                    <a
                                        href="./fifth1sem_ct.php"
                                        class="flex items-center w-full p-2 text-gray-900 text-sm transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">First Semester CT</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

            

                <!-- Logout Button -->
                <li class="mt-auto">
                    <a href="logout.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                    </a>
                </li>
                <!-- Theme Toggle Button -->
                <li>
                    <button id="theme-toggle" type="button" class="flex items-center w-full p-2.5 text-sm font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 dark:bg-gray-600 group-hover:bg-gray-200 dark:group-hover:bg-gray-500 transition-all duration-200">
                            <svg id="theme-toggle-dark-icon" class="hidden w-4 h-4 text-gray-600 dark:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-4 h-4 text-gray-600 dark:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path>
                            </svg>
                        </div>
                        <span class="ms-3 whitespace-nowrap">Appearance</span>
                        <span class="ms-auto text-sm font-light text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">Light/Dark</span>
                    </button>
                </li>
            </ul>
        </div>
    </aside>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="js/theme-toggle.js"></script>
</body>

</html>