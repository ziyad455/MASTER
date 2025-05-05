<?php
  session_start();
  session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Company | Workforce Solutions</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="css/custom.css">
</head>
<body class="font-sans bg-gray-50">
  
  <nav class="flex items-center justify-between bg-gradient-to-tr from-blue-600 to-blue-900 p-4 text-white shadow-lg">
    <div class="text-xl font-medium tracking-tight">YourCompany</div>
    <div class="flex space-x-4">
      <a href="http://localhost/my-web/employees-managment/public/views/login.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">Login</a>
      <a href="signup.php" class="bg-white text-blue-600 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-100 transition">Sign Up</a>
    </div>
  </nav>


  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center">
      <h1 class="text-4xl font-light tracking-tight text-gray-900 sm:text-5xl">
        <span class="block">Modern Workforce</span>
        <span class="block text-blue-600">Management Solutions</span>
      </h1>
      <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
        Streamline your hiring process and employee management with our intuitive platform.
      </p>
      <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
        <div class="rounded-md shadow">
          <a href="signup.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-3 md:text-sm md:px-6">
            Request a Job
          </a>
        </div>
        <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
          <a href="http://localhost/my-web/employees-managment/public/views/login.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50 md:py-3 md:text-sm md:px-6">
            Existing User? Login
          </a>
        </div>
      </div>
    </div>
  </div>


  <div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="lg:text-center">
        <h2 class="text-base text-blue-600 font-medium uppercase tracking-wider">Features</h2>
        <p class="mt-2 text-2xl font-light text-gray-900 sm:text-3xl">
          Simple, powerful workforce tools
        </p>
      </div>

      <div class="mt-10">
        <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
          <div class="relative">
            <div class="absolute flex items-center justify-center h-10 w-10 rounded-md bg-blue-500 text-white">
              <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
            </div>
            <p class="ml-16 text-lg font-medium text-gray-900">Job Management</p>
            <p class="mt-1 ml-16 text-base text-gray-500">
              Post and track job requests with ease.
            </p>
          </div>

          <div class="relative">
            <div class="absolute flex items-center justify-center h-10 w-10 rounded-md bg-blue-500 text-white">
              <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
              </svg>
            </div>
            <p class="ml-16 text-lg font-medium text-gray-900">Employee Tracking</p>
            <p class="mt-1 ml-16 text-base text-gray-500">
              Monitor your team's progress and performance.
            </p>
          </div>

          <div class="relative">
            <div class="absolute flex items-center justify-center h-10 w-10 rounded-md bg-blue-500 text-white">
              <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
              </svg>
            </div>
            <p class="ml-16 text-lg font-medium text-gray-900">Secure Platform</p>
            <p class="mt-1 ml-16 text-base text-gray-500">
              Your data is protected with enterprise security.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>


  <footer class="bg-gray-50">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
      <p class="text-center text-sm text-gray-500">
        &copy; 2023 YourCompany. All rights reserved.
      </p>
    </div>
  </footer>
</body>
</html>