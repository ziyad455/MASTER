<?php require("nav.php"); ?>
<?php 
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: http://localhost/my-web/EMPLOYEES-MANAGMENT/404.php");
    exit();
}
?>

<?php
 require (str_replace('\\', '/', 'C:\xampp\htdocs\my-web\employees-managment\app\database\conectdb.php'));
$tasks_Due_Today = $db->selectOne("SELECT COUNT(*) as count FROM tasks WHERE DATE(due_date) = CURDATE()");
$overdue_tasks = $db->selectOne("SELECT COUNT(*) as count FROM tasks WHERE due_date < CURDATE() AND status != 'completed'");
$qury = "SELECT count(*) FROM users WHERE id not in (SELECT user_id FROM employees) and role = 'employee'";
$result = $db->selectOne($qury);
$activitys = $db->selectAll("SELECT * FROM activity ORDER BY created_at DESC LIMIT 5");


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>

  <link rel="stylesheet" href="http://localhost/my-web/EMPLOYEES-MANAGMENT/public/assist/css/admin/home.css">
</head>
<body class="bg-gray-100">



  <div class="container mx-auto px-4 py-8 mt-16">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Dashboard Overview</h1>
    
   
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
   
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Pending Job Requests</p>
            <h3 class="text-3xl font-bold text-indigo-600 mt-2"><?php echo $result['count(*)'] ?></h3>
          </div>
          <div class="bg-indigo-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
          </div>
        </div>
        <a href="job_requests.php" class="text-indigo-600 text-sm font-medium mt-4 inline-block hover:underline">View all requests</a>
      </div>

      <!-- Today's Tasks -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Tasks Due Today</p>
            <h3 class="text-3xl font-bold text-indigo-600 mt-2 "><?php echo $tasks_Due_Today['count']?></h3>
          </div>
          <div class="bg-indigo-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
          </div>
        </div>
        <a href="tasks.php" class="text-indigo-600 text-sm font-medium mt-4 inline-block hover:underline">View today's tasks</a>
      </div>

      <!-- Overdue Tasks -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Overdue Tasks</p>
            <h3 class="text-3xl font-bold text-indigo-600 mt-2"><?php echo $overdue_tasks['count']?></h3>
          </div>
          <div class="bg-indigo-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
        </div>
        <a href="tasks.php?filter=overdue" class="text-indigo-600 text-sm font-medium mt-4 inline-block hover:underline">View overdue tasks</a>
      </div>

      <!-- Lazy Employees -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Employees with >4 Tasks</p>
            <h3 class="text-3xl font-bold text-indigo-600 mt-2">2</h3>
          </div>
          <div class="bg-indigo-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
          </div>
        </div>
        <a href="employees.php?filter=overloaded" class="text-indigo-600 text-sm font-medium mt-4 inline-block hover:underline">View employees</a>
      </div>
    </div>


    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">Recent Activity</h2>
        <a href="activity.php" class="text-indigo-600 text-sm font-medium hover:underline">View all</a>
      </div>
      
      <div class="space-y-4">
  <?php foreach ($activitys as $activity): ?>
    <div class="flex items-start">
      <?php $resulot = explode(',', $activity['description']);
      if($activity['category'] === 'job_request'){
        echo '
        <div class="bg-indigo-100 p-2 rounded-full mr-4">
          <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
        </div>';
      }
      elseif($activity['category'] === 'update'){
        echo '
        <div class="bg-indigo-100 p-2 rounded-full mr-4">
          <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>';
      }
      ?>

      <div>
      <p class="font-medium">
          <?php 
            if (count($resulot) == 4) {
              echo  $resulot[0] . 
                  ' <span class="text-blue-600"> "' . $resulot[1] . '"  </span> ' . 
                   $resulot[2] . 
                  '<span class="text-orange-600">' . strtoupper($resulot[3]) . '</span> ';
            } else {
              echo  $resulot[0] . 
                  ' <span class="text-orange-600">' . strtoupper($resulot[1]) . '</span> ';
            }
          ?>
      </p>

        <?php
        $created_at = new DateTime($activity['created_at']);
        $now = new DateTime();
        $interval = $now->diff($created_at);
        if ($interval->y > 0) {
          $time_ago = $interval->y . ' years ago';
        } elseif ($interval->m > 0) {
          $time_ago = $interval->m . ' months ago';
        } elseif ($interval->d > 0) {
          $time_ago = $interval->d . ' days ago';
        } elseif ($interval->h > 0) {
          $time_ago = $interval->h . ' hours ago';
        } elseif ($interval->i > 0) {
          $time_ago = $interval->i . ' minutes ago';
        } else {
          $time_ago = 'Just now';
        }
        ?>
        <p class="text-gray-500 text-sm"><?php echo $time_ago ?></p>
      </div>
    </div>
  <?php endforeach; ?>
</div>


    <!-- Employees with Many Tasks Section -->
    <div class="bg-white rounded-lg shadow-md p-6">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">Employees with Many Pending Tasks</h2>
        <a href="employees.php" class="text-indigo-600 text-sm font-medium hover:underline">View all employees</a>
      </div>
      
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pending Tasks</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Overdue Tasks</th>
              <th scope="col" class="relative px-6 py-3"><span class="sr-only">Action</span></th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10">
                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                      <span class="text-indigo-600 font-medium">JD</span>
                    </div>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">John Doe</div>
                    <div class="text-sm text-gray-500">Developer</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">5</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">2</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <a href="assign_task.php?employee_id=1" class="text-indigo-600 hover:text-indigo-900">Assign Task</a>
              </td>
            </tr>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10">
                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                      <span class="text-indigo-600 font-medium">SM</span>
                    </div>
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">Sarah Miller</div>
                    <div class="text-sm text-gray-500">Designer</div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">4</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">1</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <a href="assign_task.php?employee_id=2" class="text-indigo-600 hover:text-indigo-900">Assign Task</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>