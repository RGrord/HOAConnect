<?php 
  include_once ($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/config.php');
  include_once ($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/session.php');
  include_once ($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/session-validate.php');
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/page-icon.php'); ?>
  <?php include_once ($_SERVER['DOCUMENT_ROOT'] . '/hoa_system/app/includes/styles.php'); ?>
</head>
<body class="min-h-screen flex flex-col">
    <header class="bg-white border-b border-gray-200 sticky top-0 z-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-4">
                <div class="flex items-center -me-10 ">
                  <span class="text-3xl text-teal-600 me-2">
                    <i class="ri-community-line"></i>
                  </span>
                  <span class="text-xl font-bold text-gray-900">HOAConnect</span>
                </div>
                <div class="hidden md:flex justify-center gap-4 m-auto">
                  <a href="#home" class="text-gray-700 hover:text-teal-600 font-medium transition-colors">
                    HOME
                  </a>
                  <a href="#about" class="text-gray-700 hover:text-teal-600 font-medium transition-colors">
                    ABOUT
                  </a>
                  <a href="#officials" class="text-gray-700 hover:text-teal-600 font-medium transition-colors">
                    HOA OFFICIALS
                  </a>
                  <a href="#projects" class="text-gray-700 hover:text-teal-600 font-medium transition-colors">
                    PROJECTS
                  </a>
                </div>
                <div>
                    <a 
                      href="<?= BASE_URL . 'public/auth/login.php'?>" 
                      class="inline-flex items-center px-2 py-2 border border-transparent text-sm font-medium 
                      rounded-md shadow-sm text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 
                      focus:ring-offset-2 focus:ring-teal-500 transition-colors">
                      <i class="ri-login-circle-line me-2"></i>Log In
                    </a>
                </div>
            </div>
        </div>
        <div class="md:hidden py-2 flex justify-around gap-2 text-sm w-100">
          <a href="#home" class="text-gray-700 hover:text-teal-600 font-medium transition-colors">
            <i class="ri-home-9-fill text-2xl"></i>
          </a>
          <a href="#about" class="text-gray-700 hover:text-teal-600 font-medium transition-colors">
            <i class="ri-information-fill text-2xl"></i>
          </a>
          <a href="#officials" class="text-gray-700 hover:text-teal-600 font-medium transition-colors">
            <i class="ri-team-fill text-2xl"></i>
          </a>
          <a href="#projects" class="text-gray-700 hover:text-teal-600 font-medium transition-colors">
            <i class="ri-award-fill text-2xl"></i>
          </a>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="bg-gradient-to-r from-teal-50 to-emerald-50 py-16 md:py-24 pattern-dots">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="animate-fadeIn">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
                        WELCOME TO HOAConnect!
                    </h1>
                    <p class="mt-4 text-xl text-gray-600">
                        Pay your fees, track your payments, and stay informed about community budgets—all in one place. 
                        Designed for <b>Mabuhay Homes 2000, Barangay Paliparan II, Dasmariñas City, Cavite</b>.
                    </p>
                    <div class="mt-8">
                        <a href="<?= BASE_URL . '/public/auth/login.php'?>" 
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium 
                        rounded-md shadow-sm text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 
                        focus:ring-offset-2 focus:ring-teal-500 transition-all transform hover:scale-105">
                            Access Your Account 
                            <i class="ri-arrow-right-long-fill ms-3"></i>
                        </a>
                    </div>
                </div>
                <div class="hidden md:block animate-fadeIn animate-delay-200">
                    <div class="relative">
                        <div class="absolute -top-6 -left-6 w-24 h-24 bg-teal-200 rounded-full opacity-50"></div>
                        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-teal-300 rounded-full opacity-40"></div>
                        <img src="https://placehold.co/500x400" alt="HOA Management" class="rounded-lg shadow-xl relative z-10">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-white pattern-grid">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 inline-block relative">
                    About HOAConnect
                    <span class="absolute bottom-0 left-0 w-full h-1 bg-teal-400 transform-translate-y-2"></span>
                </h2>
                <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">
                    Our mission is to create a transparent and efficient system for managing homeowners' association affairs.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="order-2 md:order-1">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">Mabuhay Homes 2000 Community</h3>
                    <p class="text-gray-600 mb-4">
                        Established in 2000, Mabuhay Homes is a thriving community located in Barangay Paliparan II, Dasmariñas
                        City, Cavite. Our community consists of over 500 families committed to maintaining a safe, clean, and
                        harmonious neighborhood.
                    </p>
                    <p class="text-gray-600 mb-4">
                        The HOAConnect system was developed to address the challenges of manual fee collection and to provide
                        complete transparency in how community funds are utilized for various projects and maintenance
                        activities.
                    </p>
                    <div class="grid grid-cols-2 gap-4 mt-6">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-teal-500 mr-2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>
                            <span>Established 2000</span>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-teal-500 mr-2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>
                            <span>500+ Families</span>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-teal-500 mr-2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>
                            <span>24/7 Security</span>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-teal-500 mr-2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg>
                            <span>Community Events</span>
                        </div>
                    </div>
                </div>
                <div class="order-1 md:order-2 flex justify-center">
                    <div class="relative">
                        <div class="absolute inset-0 bg-teal-200 rounded-lg rotate-3"></div>
                        <img src="https://placehold.co/450x350" alt="Mabuhay Homes Community" class="rounded-lg shadow-lg relative">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 inline-block relative">
                    Features of HOAConnect
                    <span class="absolute bottom-0 left-0 w-full h-1 bg-teal-400"></span>
                </h2>
                <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">
                    Our system provides a seamless experience for homeowners and association management.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow transform hover:-translate-y-1 duration-300">
                    <div class="bg-teal-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-teal-600">
                            <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                            <line x1="2" x2="22" y1="10" y2="10"></line>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Automated Fee Collection</h3>
                    <p class="text-gray-600">
                        Easily track and pay your HOA fees online with automated reminders and payment confirmations.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow transform hover:-translate-y-1 duration-300">
                    <div class="bg-teal-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-teal-600">
                            <path d="M3 3v18h18"></path>
                            <path d="m19 9-5 5-4-4-3 3"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Budget Transparency</h3>
                    <p class="text-gray-600">
                        View detailed reports on how your HOA fees are being utilized for community improvements.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow transform hover:-translate-y-1 duration-300">
                    <div class="bg-teal-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-teal-600">
                            <path d="M20 5H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2Z"></path>
                            <path d="M12 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
                            <path d="M12 12v4"></path>
                            <path d="M8 18h8"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Secure Access</h3>
                    <p class="text-gray-600">
                        Your financial information is protected with industry-standard security measures.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- HOA Officials Section -->
    <section id="officials" class="py-16 bg-white pattern-diagonal">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 inline-block relative">
                    HOA Officials
                    <span class="absolute bottom-0 left-0 w-full h-1 bg-teal-400 transform-translate-y-2"></span>
                </h2>
                <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">
                    Meet the dedicated team working to improve our community.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Official 1 -->
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-lg transition-all text-center">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4 border-4 border-teal-200">
                        <img src="https://placehold.co/128x128" alt="President" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Juan Dela Cruz</h3>
                    <p class="text-teal-600 font-medium">President</p>
                    <p class="mt-2 text-gray-600 text-sm">
                        Leading our community since 2022 with a focus on infrastructure improvements.
                    </p>
                </div>

                <!-- Official 2 -->
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-lg transition-all text-center">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4 border-4 border-teal-200">
                        <img src="https://placehold.co/128x128" alt="Vice President" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Maria Santos</h3>
                    <p class="text-teal-600 font-medium">Vice President</p>
                    <p class="mt-2 text-gray-600 text-sm">
                        Coordinating community events and resident engagement programs.
                    </p>
                </div>

                <!-- Official 3 -->
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-lg transition-all text-center">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4 border-4 border-teal-200">
                        <img src="https://placehold.co/128x128" alt="Secretary" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Antonio Reyes</h3>
                    <p class="text-teal-600 font-medium">Secretary</p>
                    <p class="mt-2 text-gray-600 text-sm">
                        Maintaining records and facilitating communication between residents and the board.
                    </p>
                </div>

                <!-- Official 4 -->
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-lg transition-all text-center">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4 border-4 border-teal-200">
                        <img src="https://placehold.co/128x128" alt="Treasurer" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Elena Gomez</h3>
                    <p class="text-teal-600 font-medium">Treasurer</p>
                    <p class="mt-2 text-gray-600 text-sm">
                        Overseeing financial management and ensuring transparent budget allocation.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 inline-block relative">
                    Community Projects
                    <span class="absolute bottom-0 left-0 w-full h-1 bg-teal-400 transform-translate-y-4"></span>
                </h2>
                <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">
                    See how your HOA fees are being utilized to improve our community.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8"> 
                <!-- Project 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
                    <div class="relative h-48">
                        <img src="https://placehold.co/400x200" alt="Road Repair Project" class="w-full h-full object-cover">
                        <div class="absolute top-0 right-0 bg-teal-500 text-white px-3 py-1 rounded-bl-lg">Completed</div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-semibold text-gray-900">Road Repair Project</h3>
                            <span class="text-sm text-gray-500">Q1 2023</span>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Repaving of main roads within the community to improve accessibility and safety.
                        </p>
                        <div class="flex justify-between items-center text-sm">
                            <span class="flex items-center text-teal-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                    <rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                                Budget: ₱500,000
                            </span>
                            <span class="flex items-center text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                                    <line x1="16" x2="16" y1="2" y2="6"></line>
                                    <line x1="8" x2="8" y1="2" y2="6"></line>
                                    <line x1="3" x2="21" y1="10" y2="10"></line>
                                </svg>
                                Duration: 2 months
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Project 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
                    <div class="relative h-48">
                        <img src="https://placehold.co/400x200" alt="Community Park Renovation" class="w-full h-full object-cover">
                        <div class="absolute top-0 right-0 bg-yellow-500 text-white px-3 py-1 rounded-bl-lg">
                            In Progress
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-semibold text-gray-900">Community Park Renovation</h3>
                            <span class="text-sm text-gray-500">Q2 2023</span>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Upgrading playground equipment and adding new landscaping to the central park.
                        </p>
                        <div class="flex justify-between items-center text-sm">
                            <span class="flex items-center text-teal-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                    <rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                                Budget: ₱750,000
                            </span>
                            <span class="flex items-center text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                                    <line x1="16" x2="16" y1="2" y2="6"></line>
                                    <line x1="8" x2="8" y1="2" y2="6"></line>
                                    <line x1="3" x2="21" y1="10" y2="10"></line>
                                </svg>
                                Duration: 4 months
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Project 3 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
                    <div class="relative h-48">
                        <img src="https://placehold.co/400x200" alt="Security System Upgrade" class="w-full h-full object-cover">
                        <div class="absolute top-0 right-0 bg-teal-500 text-white px-3 py-1 rounded-bl-lg">Completed</div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-semibold text-gray-900">Security System Upgrade</h3>
                            <span class="text-sm text-gray-500">Q4 2022</span>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Installation of CCTV cameras and improved gate access control systems.
                        </p>
                        <div class="flex justify-between items-center text-sm">
                            <span class="flex items-center text-teal-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                    <rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                                Budget: ₱350,000
                            </span>
                            <span class="flex items-center text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                                    <line x1="16" x2="16" y1="2" y2="6"></line>
                                    <line x1="8" x2="8" y1="2" y2="6"></line>
                                    <line x1="3" x2="21" y1="10" y2="10"></line>
                                </svg>
                                Duration: 1 month
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Project 4 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
                    <div class="relative h-48">
                        <img src="https://placehold.co/400x200" alt="Drainage System Improvement" class="w-full h-full object-cover">
                        <div class="absolute top-0 right-0 bg-blue-500 text-white px-3 py-1 rounded-bl-lg">Planned</div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-semibold text-gray-900">Drainage System Improvement</h3>
                            <span class="text-sm text-gray-500">Q3 2023</span>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Upgrading the community's drainage system to prevent flooding during rainy seasons.
                        </p>
                        <div class="flex justify-between items-center text-sm">
                            <span class="flex items-center text-teal-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                    <rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                                Budget: ₱1,200,000
                            </span>
                            <span class="flex items-center text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-1">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                                    <line x1="16" x2="16" y1="2" y2="6"></line>
                                    <line x1="8" x2="8" y1="2" y2="6"></line>
                                    <line x1="3" x2="21" y1="10" y2="10"></line>
                                </svg>
                                Duration: 6 months
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="login.html" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-all">
                    View All Projects 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2 h-5 w-5">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-teal-600 py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Ready to manage your HOA fees efficiently?</h2>
            <p class="text-xl text-teal-100 mb-8 max-w-3xl mx-auto">
                Log in to your account to access all features of the HOAConnect system.
            </p>
            <a href="<?= BASE_URL . 'public/auth/login.php'?>" 
            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md 
            shadow-sm text-teal-600 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 
            focus:ring-white transition-all transform hover:scale-105">
                Log In Now 
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2 h-5 w-5">
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 py-12 mt-auto">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-teal-400">
                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                            <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path>
                            <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path>
                            <path d="M10 6h4"></path>
                            <path d="M10 10h4"></path>
                            <path d="M10 14h4"></path>
                            <path d="M10 18h4"></path>
                        </svg>
                        <span class="ml-2 text-xl font-bold text-white">HOAConnect</span>
                    </div>
                    <p class="mt-4 text-gray-300 max-w-md">
                        An automated homeowners' association fee collection and budget transparency system for Mabuhay Homes
                        2000, Barangay Paliparan II, Dasmariñas City, Cavite.
                    </p>
                </div>

                <div class="mt-8 md:mt-0">
                    <h3 class="text-white text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="#home" class="text-gray-300 hover:text-teal-400 transition-colors">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#about" class="text-gray-300 hover:text-teal-400 transition-colors">
                                About
                            </a>
                        </li>
                        <li>
                            <a href="#officials" class="text-gray-300 hover:text-teal-400 transition-colors">
                                HOA Officials
                            </a>
                        </li>
                        <li>
                            <a href="#projects" class="text-gray-300 hover:text-teal-400 transition-colors">
                                Projects
                            </a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL . 'public/auth/login.php'?>" class="text-gray-300 hover:text-teal-400 transition-colors">
                                Login
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="mt-8 md:mt-0">
                    <h3 class="text-white text-lg font-semibold mb-4">Contact Information</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-teal-400 mr-2 mt-0.5">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <span class="text-gray-300">
                                HOA Office, Mabuhay Homes 2000, Barangay Paliparan II, Dasmariñas City, Cavite
                            </span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-teal-400 mr-2">
                                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                            </svg>
                            <span class="text-gray-300">info@hoaconnect.example.com</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-teal-400 mr-2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            <span class="text-gray-300">(046) 123-4567</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-700 text-center">
                <p class="text-gray-400">&copy; <script>document.write(new Date().getFullYear())</script> HOAConnect. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>