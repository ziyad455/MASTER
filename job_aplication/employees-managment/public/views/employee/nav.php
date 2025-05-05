<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} else {
    if (!isset($_SESSION['employee'])) {
        header("Location: http://localhost/my-web/EMPLOYEES-MANAGMENT/404.php");
        exit();
    }

}




require(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) . '/my-web/EMPLOYEES-MANAGMENT/public/assist/other/isselected.php'); 

?>
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
<!-- Heroicons User Circle -->
<svg
  id="the_thing"
  xmlns="http://www.w3.org/2000/svg"
  class="h-10 w-10 text-black hover:text-blue-500 cursor-pointer transition duration-200"
  fill="none"
  viewBox="0 0 24 24"
  stroke="currentColor"
  stroke-width="2"
>
  <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 0112 15a9 9 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
</svg>


      <h1 class="md:text-xl font-bold text-lg">Employee <br> Management</h1>
    </div>
  

    <ul class="hidden md:flex space-x-6 mx-auto">
      <li><a class="text-slate-900 hover:text-blue-900 transition duration-500 <?php echo isSelected('home')?>" href="home.php">Home</a></li>
      <li><a class="text-slate-900 hover:text-blue-600 transition duration-500 <?php echo isSelected('Tasks')?>" href="Tasks.php">My Tasks</a></li>


    </ul>
  
    <a href="http://localhost/my-web/employees-managment/public/views/guiest.php" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-500 hidden md:block">Logout</a>
  

    <button class="md:hidden block text-2xl text-slate-800 cursor-pointer hover:text-blue-600 transition absolute right-4 top-4" id="menu-toggle" title="Toggle Menu">
      <i class="fa-solid fa-bars"></i>
    </button>
    
  

   
  <ul class="flex md:hidden flex-col absolute z-10 space-y-2 bg-white p-4 rounded shadow-lg right-4 top-23 h-full" id="menu">
    <li><a class="text-slate-800 hover:text-blue-900 transition duration-500 <?php echo isSelected('home') ?>" href="home.php">Home</a></li>
    <li><a class="text-slate-800 hover:text-blue-600 transition duration-500 <?php echo isSelected('Tasks') ?>" href="Tasks.php">My Tasks</a></li>

    <li><a class="text-slate-800 hover:text-red-500 transition duration-500" href="http://localhost/my-web/employees-managment/public/views/guiest.php">Logout</a></li>
  </ul>

    
  </nav>

<div id="sidebarBackdrop" class="fixed inset-0 z-40 hidden"></div>

<!-- Sidebar -->
<div id="employeeSidebar" class="fixed top-22 right-0 h-full w-80 bg-white shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50">
  <div class="p-6">
    <div class="flex justify-between items-center mb-6">
      <h3 class="text-lg font-medium text-slate-900 underline">Employee Details</h3>
      <button id="closeSidebar" class="text-indigo-600 hover:text-gray-700">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    
    <div class="space-y-4">
      <div>
        <h4 class="text-sm font-medium text-indigo-600">Full Name</h4>
        <p id="sidebarName" class="mt-1 text-sm text-gray-900"></p>
      </div>
      
      <div>
        <h4 class="text-sm font-medium text-indigo-600">Email</h4>
        <p id="sidebarEmail" class="mt-1 text-sm text-gray-900"></p>
      </div>
      
      <div>
        <h4 class="text-sm font-medium text-indigo-600">Country</h4>
        <p id="sidebarCountry" class="mt-1 text-sm text-gray-900"></p>
      </div>
      
      <div>
        <h4 class="text-sm font-medium text-indigo-600">Salary</h4>
        <p id="sidebarSalary" class="mt-1 text-sm text-gray-900"></p>
      </div>
      
      <div>
        <h4 class="text-sm font-medium text-indigo-600">Hire Date</h4>
        <p id="sidebarHireDate" class="mt-1 text-sm text-gray-900"></p>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const sidebar = document.getElementById('employeeSidebar');
  const backdrop = document.getElementById('sidebarBackdrop');
  const closeBtn = document.getElementById('closeSidebar');
  

  function openSidebar(employeeData) {
    document.getElementById('sidebarName').textContent = employeeData.name;
    document.getElementById('sidebarEmail').textContent = employeeData.email;
    document.getElementById('sidebarCountry').textContent = employeeData.country;
    document.getElementById('sidebarSalary').textContent = '$' + employeeData.salary.toLocaleString();
    document.getElementById('sidebarHireDate').textContent = new Date(employeeData.hire_date).toLocaleDateString();
    
    sidebar.classList.remove('translate-x-full');
    backdrop.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }
  

  function closeSidebar() {
    sidebar.classList.add('translate-x-full');
    backdrop.classList.add('hidden');
    document.body.style.overflow = 'auto';
  }
  
 
  document.getElementById('the_thing').addEventListener('click', function(e) {
    e.stopPropagation();
    const employeeData = {
      name: '<?php echo strtoupper($_SESSION['user']['name'])  ?>',
      email: '<?php echo $_SESSION['user']['email'] ?>',
      country: '<?php echo $_SESSION['user']['country'] ?>',
      salary: <?php echo $_SESSION['employee']['salary'] ?>,
      hire_date: '<?php echo $_SESSION['employee']['hire_date'] ?>'
    };


    openSidebar(employeeData);
  });
  

  backdrop.addEventListener('click', closeSidebar);
  

  closeBtn.addEventListener('click', closeSidebar);
  

  document.addEventListener('click', function(e) {
    if (!sidebar.contains(e.target) && e.target.id !== 'the_thing') {
      closeSidebar();
    }
  });
});
</script>
  
  
  <script src="http://localhost/my-web/EMPLOYEES-MANAGMENT/public/assist/js/nav.js"></script>
</body>
</html>