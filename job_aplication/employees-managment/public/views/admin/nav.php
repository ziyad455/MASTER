<?php 
session_start();
require(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) . '/my-web/EMPLOYEES-MANAGMENT/public/assist/other/isselected.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>emplyee||mangment</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="http://localhost/my-web/EMPLOYEES-MANAGMENT/public/assist/css/nav.css">
</head>
<body>
  <nav class="flex items-center justify-between bg-gradient-to-tr from-blue-600 to-blue-900 p-4 text-white shadow-lg">
    <div class="flex items-center space-x-4">
      <img class="h-10 w-10" src="http://localhost/my-web/EMPLOYEES-MANAGMENT/public/assist/img/logo.png" alt="Logo">
      <h1 class="md:text-xl font-bold text-lg">Employee <br> Management</h1>
    </div>
  

    <ul class="hidden md:flex space-x-6 mx-auto">
      <li><a class="text-slate-900 hover:text-blue-900 transition duration-500 <?php echo isSelected('home')?>" href="home.php">Home</a></li>
      <li><a class="text-slate-900 hover:text-blue-600 transition duration-500 <?php echo isSelected('job_r')?>" href="job_r.php">Job Requests</a></li>
      <li><a class="text-slate-900 hover:text-blue-600 transition duration-500 <?php echo isSelected('tasks')?>" href="tasks.php">Tasks</a></li>
      <li><a class="text-slate-900 hover:text-blue-600 transition duration-500 <?php echo isSelected('employees')?>" href="employees.php">Employees</a></li>

    </ul>
  
    <a href="http://localhost/my-web/employees-managment/public/views/guiest.php" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-500 hidden md:block">Logout</a>
  

    <button class="md:hidden block text-2xl text-slate-800 cursor-pointer hover:text-blue-600 transition absolute right-4 top-4" id="menu-toggle" title="Toggle Menu">
      <i class="fa-solid fa-bars"></i>
    </button>
    
  

   
  <ul class="flex md:hidden flex-col absolute z-10 space-y-2 bg-white p-4 rounded shadow-lg right-4 top-23 h-full" id="menu">
  <li><a class="text-slate-900 hover:text-blue-900 transition duration-500 <?php echo isSelected('home')?>" href="home.php">Home</a></li>
      <li><a class="text-slate-900 hover:text-blue-600 transition duration-500 <?php echo isSelected('job_r')?>" href="job_r.php">Job Requests</a></li>
      <li><a class="text-slate-900 hover:text-blue-600 transition duration-500 <?php echo isSelected('tasks')?>" href="tasks.php">Tasks</a></li>
      <li><a class="text-slate-900 hover:text-blue-600 transition duration-500 <?php echo isSelected('employees')?>" href="employees.php">Employees</a></li>
    <li><a class="text-slate-800 hover:text-red-500 transition duration-500" href="http://localhost/my-web/employees-managment/public/views/guiest.php">Logout</a></li>
  </ul>

    
  </nav>
  
  
  <script src="http://localhost/my-web/EMPLOYEES-MANAGMENT/public/assist/js/nav.js"></script>
</body>
</html>