<?php require("nav.php"); 
if (!isset($_SESSION['employee']) ) {
  header("Location: http://localhost/my-web/EMPLOYEES-MANAGMENT/404.php");
  exit();
}?>


<?php 

require (str_replace('\\', '/', 'C:\xampp\htdocs\my-web\employees-managment\app\database\conectdb.php')); 
require(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) . '/my-web/EMPLOYEES-MANAGMENT/public/assist/other/status.php');
$today = new DateTime();
$filter = $_GET['filter'] ?? 'all';
$sql = "SELECT * FROM tasks WHERE assigned_to = ? AND status != 'completed' ORDER BY due_date ASC";
switch ($filter) {
    case 'today':
        $sql = 'SELECT * FROM tasks WHERE assigned_to = ? AND DATE(due_date) = DATE(NOW()) ORDER BY due_date DESC';
        break;
    case 'this_week':
        $sql = 'SELECT * FROM tasks WHERE assigned_to = ? AND WEEK(due_date) = WEEK(NOW()) ORDER BY due_date DESC';
        break;
    case 'completed':
        $sql = 'SELECT * FROM tasks WHERE assigned_to = ? AND status = "completed" ORDER BY due_date DESC';
        break;
    case 'pending':
        $sql = 'SELECT * FROM tasks WHERE assigned_to = ? AND status = "pending" ORDER BY due_date DESC';
        break;
    case 'in_progress':
        $sql = 'SELECT * FROM tasks WHERE assigned_to = ? AND status = "in_progress" ORDER BY due_date DESC';
        break;
    case 'overdue':
        $sql = 'SELECT * FROM tasks WHERE assigned_to = ? AND due_date < NOW() ORDER BY due_date DESC';
        break;
}

$tasks = $db->selectALL($sql, [$_SESSION['employee']['user_id']]);


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Tasks</title>

  <link rel="stylesheet" href="http://localhost/my-web/EMPLOYEES-MANAGMENT/public/assist/css/employee/tasks.css">
</head>
<body class="bg-gray-100">

  <div class="container mx-auto px-4 py-8 mt-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
      <h1 class="text-3xl font-bold text-gray-800 mb-4 md:mb-0">My Tasks</h1>
      

      <div class="bg-white rounded-lg shadow-sm px-4 py-2 flex items-center">
        <span class="text-gray-500 mr-2">Total Tasks:</span>
        <span class="font-semibold text-indigo-600"><?php echo count($tasks); ?></span>
      </div>
    </div>
    
    
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
      <div class="flex flex-wrap gap-2">
      <a href="Tasks.php"
   class="px-4 py-2 rounded-md transition 
   <?php echo ($filter === 'all') ? 'bg-indigo-600 text-white' : 'bg-indigo-100 text-indigo-800 hover:bg-indigo-200'; ?>">
   All Tasks
      </a>

      <a href="Tasks.php?filter=today"
        class="px-4 py-2 rounded-md transition 
        <?php echo ($filter === 'today') ? 'bg-black text-white' : 'bg-indigo-100 text-indigo-800 hover:bg-indigo-200'; ?>">
        Today's Tasks
      </a>

      <a href="Tasks.php?filter=this_week"
        class="px-4 py-2 rounded-md transition 
        <?php echo ($filter === 'this_week') ? 'bg-yellow-900 text-white' : 'bg-indigo-100 text-indigo-800 hover:bg-indigo-200'; ?>">
        This Week
      </a>

      <a href="Tasks.php?filter=completed"
        class="px-4 py-2 rounded-md transition 
        <?php echo ($filter === 'completed') ? 'bg-green-600 text-white' : 'bg-indigo-100 text-indigo-800 hover:bg-indigo-200'; ?>">
        Completed
      </a>

      <a href="Tasks.php?filter=pending"
        class="px-4 py-2 rounded-md transition 
        <?php echo ($filter === 'pending') ? 'bg-orange-600 text-white' : 'bg-indigo-100 text-indigo-800 hover:bg-indigo-200'; ?>">
        Pending
      </a>

      <a href="Tasks.php?filter=in_progress"
        class="px-4 py-2 rounded-md transition 
        <?php echo ($filter === 'in_progress') ? 'bg-amber-600 text-white' : 'bg-indigo-100 text-indigo-800 hover:bg-indigo-200'; ?>">
        In Progress
      </a>

      <a href="Tasks.php?filter=overdue"
        class="px-4 py-2 rounded-md transition 
        <?php echo ($filter === 'overdue') ? 'bg-red-600 text-white' : 'bg-indigo-100 text-indigo-800 hover:bg-indigo-200'; ?>">
        Overdue
      </a>

      </div>
    </div>



    <div class="bg-white rounded-lg shadow-md overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th scope="col" class="relative px-6 py-3">
              <span class="sr-only">Actions</span>
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php foreach ($tasks as $task): ?>
            

          <tr>
          <td class="px-6 py-4">
            <div class="text-sm font-medium text-gray-900"><?php echo $task['title']; ?></div>
            <div class="text-xs text-gray-500 mt-1"><?php echo $task['description']; ?></div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900"><?php echo $task['due_date']; ?></div>
            <div class="text-xs text-red-500 font-medium">
              <?php
              $dueDate = new DateTime($task['due_date']);
              $today = new DateTime();

              $interval = $today->diff($dueDate);
              $daysLeft = (int)$interval->format('%r%a'); 

              if ($daysLeft < 0) {
                  echo 'Overdue';
              } else {
                  echo $daysLeft . ' Days left';
               }

              ?>
            </div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo status($task['status']); ?>">
              <?php echo $task['status']; ?>
            </span>
          </td>


            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <a href="http://localhost/my-web/employees-managment/app/brain/employee/updat_handling.php?task_id=<?php echo $task['id']; ?>" class="text-indigo-600 hover:text-indigo-900 mr-3 up">Update</a>
              <a href="task_details.php?task_id=1" class="text-gray-600 hover:text-gray-900">Details</a>
            </td>
          </tr>
          <?php endforeach ?>
          

        </tbody>
      </table>
      
      
      <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="flex-1 flex justify-between sm:hidden">
          <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            Previous
          </a>
          <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            Next
          </a>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
          <div>
            <p class="text-sm text-gray-700">
              Showing <span class="font-medium">1</span> to <span class="font-medium">7</span> of <span class="font-medium">12</span> results
            </p>
          </div>
          <div>
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
              <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Previous</span>
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
              </a>
              <a href="#" aria-current="page" class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                1
              </a>
              <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                2
              </a>
              <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                3
              </a>
              <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Next</span>
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
              </a>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Update Status Modal -->
<div id="statusModal" class="fixed inset-0 transition-opacity z-40 hidden">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full relative z-50"> 
      <form method="POST" action="http://localhost/my-web/employees-managment/app/brain/employee/updat_handling.php">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Update Task Status</h3>
          <input type="hidden" id="modalTaskId" name="task_id">
          
          <div class="grid grid-cols-2 gap-4">
            <button type="button" data-status="pending" class="status-option flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
              <span class="w-3 h-3 rounded-full bg-gray-300 mr-2"></span>
              pending
            </button>
            
            <button type="button" data-status="in_progress" class="status-option flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
              <span class="w-3 h-3 rounded-full bg-blue-500 mr-2"></span>
              in_progress
            </button>
            
            <button type="button" data-status="completed" class="status-option flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
              <span class="w-3 h-3 rounded-full bg-green-500 mr-2"></span>
              completed
            </button>
  
          </div>
          
          <input type="hidden" id="selectedStatus" name="status">
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
            Update Status
          </button>
          <button type="button" id="cancelModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="http://localhost/my-web/EMPLOYEES-MANAGMENT/public/assist/js/employee/update.js"></script>
</body>
</html>