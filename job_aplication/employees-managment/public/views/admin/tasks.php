<?php require("nav.php"); 
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  header("Location: http://localhost/my-web/EMPLOYEES-MANAGMENT/404.php");
  exit();
}?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tasks Management</title>
  <link rel="stylesheet" href="http://localhost/my-web/EMPLOYEES-MANAGMENT/public/assist/css/admin/tasks.css">
</head>
<body class="bg-gray-50">
  <div class="container mx-auto px-4 py-8">
  
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
      <h1 class="text-3xl font-bold text-gray-800">Tasks Management</h1>
      <a href="add.php" class="mt-4 md:mt-0 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Add New Task
      </a>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
   
      <a href="tasks.php?filter=today" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition cursor-pointer">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Today's Tasks</p>
            <h3 class="text-2xl font-bold text-blue-600 mt-2">12</h3>
          </div>
          <div class="bg-blue-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
          </div>
        </div>
      </a>

      <!-- Overdue Tasks -->
      <a href="tasks.php?filter=overdue" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition cursor-pointer">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Overdue Tasks</p>
            <h3 class="text-2xl font-bold text-red-600 mt-2">5</h3>
          </div>
          <div class="bg-red-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
        </div>
      </a>

      <!-- Completed Tasks -->
      <a href="tasks.php?filter=completed" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition cursor-pointer">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Completed</p>
            <h3 class="text-2xl font-bold text-green-600 mt-2">24</h3>
          </div>
          <div class="bg-green-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
        </div>
      </a>

      <!-- All Tasks -->
      <a href="tasks.php" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition cursor-pointer">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">All Tasks</p>
            <h3 class="text-2xl font-bold text-gray-600 mt-2">42</h3>
          </div>
          <div class="bg-gray-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
          </div>
        </div>
      </a>
    </div>

    <!-- Recent Tasks -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
      <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">Recent Tasks</h2>
      </div>
      <div class="divide-y divide-gray-200">
        <!-- Task 1 -->
        <div class="px-6 py-4 hover:bg-gray-50 transition">
          <div class="flex items-center justify-between">
            <div>
              <h3 class="text-lg font-medium text-gray-800">Update company website</h3>
              <p class="text-sm text-gray-500 mt-1">Assigned to John Doe · Due tomorrow</p>
            </div>
            <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">In Progress</span>
          </div>
        </div>
        
        <!-- Task 2 -->
        <div class="px-6 py-4 hover:bg-gray-50 transition">
          <div class="flex items-center justify-between">
            <div>
              <h3 class="text-lg font-medium text-gray-800">Prepare quarterly report</h3>
              <p class="text-sm text-gray-500 mt-1">Assigned to Sarah Smith · Due in 3 days</p>
            </div>
            <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
          </div>
        </div>
        
        <!-- Task 3 -->
        <div class="px-6 py-4 hover:bg-gray-50 transition">
          <div class="flex items-center justify-between">
            <div>
              <h3 class="text-lg font-medium text-gray-800">Client meeting preparation</h3>
              <p class="text-sm text-gray-500 mt-1">Assigned to Mike Johnson · Overdue</p>
            </div>
            <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Urgent</span>
          </div>
        </div>
      </div>
      <div class="px-6 py-4 border-t border-gray-200 text-center">
        <a href="tasks.php" class="text-blue-600 hover:text-blue-500 font-medium">View all tasks →</a>
      </div>
    </div>

    <!-- Quick Links -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Employee Performance -->
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
          <h2 class="text-xl font-semibold text-gray-800">Employee Performance</h2>
        </div>
        <div class="p-6">
          <div class="space-y-4">
            <div>
              <div class="flex justify-between text-sm mb-1">
                <span>John Doe</span>
                <span>4/5 tasks completed</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-green-600 h-2.5 rounded-full" style="width: 80%"></div>
              </div>
            </div>
            <div>
              <div class="flex justify-between text-sm mb-1">
                <span>Sarah Smith</span>
                <span>2/3 tasks completed</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-yellow-500 h-2.5 rounded-full" style="width: 66%"></div>
              </div>
            </div>
            <div>
              <div class="flex justify-between text-sm mb-1">
                <span>Mike Johnson</span>
                <span>1/4 tasks completed</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-red-600 h-2.5 rounded-full" style="width: 25%"></div>
              </div>
            </div>
          </div>
          <div class="mt-4 text-center">
            <a href="employee_performance.php" class="text-blue-600 hover:text-blue-500 text-sm font-medium">View detailed performance →</a>
          </div>
        </div>
      </div>

     
      <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
          <h2 class="text-xl font-semibold text-gray-800">Quick Actions</h2>
        </div>
        <div class="p-6 grid grid-cols-2 gap-4">
          <a href="tasks.php?filter=unassigned" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition text-center">
            <svg class="w-8 h-8 mx-auto text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
            <p class="mt-2 text-sm font-medium">Unassigned Tasks</p>
          </a>
          <a href="task_categories.php" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition text-center">
            <svg class="w-8 h-8 mx-auto text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
            </svg>
            <p class="mt-2 text-sm font-medium">Task Categories</p>
          </a>
          <a href="reports.php" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition text-center">
            <svg class="w-8 h-8 mx-auto text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <p class="mt-2 text-sm font-medium">Generate Reports</p>
          </a>
          <a href="settings.php" class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition text-center">
            <svg class="w-8 h-8 mx-auto text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <p class="mt-2 text-sm font-medium">Task Settings</p>
          </a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>