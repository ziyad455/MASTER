<?php require("nav.php"); 
if (!isset($_SESSION['employee']) ) {
  header("Location: http://localhost/my-web/EMPLOYEES-MANAGMENT/404.php");
  exit();
}?>
<?php 
require (str_replace('\\', '/', 'C:\xampp\htdocs\my-web\employees-managment\app\database\conectdb.php')); 
$tasks = $db->selectALL("SELECT * FROM tasks WHERE assigned_to = ? AND status != 'completed' ORDER BY due_date ASC", [$_SESSION['user']['id']]);
$today = $db->selectALL("SELECT * FROM tasks WHERE assigned_to = ? AND DATE(due_date) = DATE(NOW()) ", [$_SESSION['user']['id']]);
$completed = $db->selectALL("SELECT * FROM tasks WHERE assigned_to = ? AND status = 'completed' ORDER BY due_date DESC", [$_SESSION['user']['id']]);

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Dashboard</title>

  <link rel="stylesheet" href="http://localhost/my-web/EMPLOYEES-MANAGMENT/public/assist/css/employee/home.css">
</head>
<body class="bg-gray-100">

  <div class="container mx-auto px-4 py-8 mt-16">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">My Dashboard</h1>
    

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">My Tasks</p>
            <h3 class="text-3xl font-bold text-indigo-600 mt-2"><?php echo count($tasks) ?></h3>
          </div>
          <div class="bg-indigo-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
            </svg>
          </div>
        </div>
        <a href="http://localhost/my-web/employees-managment/public/views/employee/Tasks.php" class="text-indigo-600 text-sm font-medium mt-4 inline-block hover:underline">View all tasks</a>
      </div>

      <!-- Due Today -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Due Today</p>
            <h3 class="text-3xl font-bold text-indigo-600 mt-2"><?php echo count($today)?></h3>
          </div>
          <div class="bg-indigo-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
        </div>
        <a href="Tasks.php?filter=today" class="text-indigo-600 text-sm font-medium mt-4 inline-block hover:underline">View today's tasks</a>
      </div>

  
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">Completed Tasks</p>
            <h3 class="text-3xl font-bold text-indigo-600 mt-2"><?php echo count($completed)?></h3>
          </div>
          <div class="bg-indigo-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
        </div>
        <a href="Tasks.php?filter=completed" class="text-indigo-600 text-sm font-medium mt-4 inline-block hover:underline">View completed</a>
      </div>

      <!-- Job Requests -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium">My Job Requests</p>
            <h3 class="text-3xl font-bold text-indigo-600 mt-2">1</h3>
          </div>
          <div class="bg-indigo-100 p-3 rounded-full">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
          </div>
        </div>
        <a href="my_requests.php" class="text-indigo-600 text-sm font-medium mt-4 inline-block hover:underline">View requests</a>
      </div>
    </div>


<?php    $notify = $db->selectALL("SELECT * FROM notify WHERE user_id = ? ORDER BY created_at DESC LIMIT 5", [$_SESSION['user']['id']]); 
$activitys = $db->selectAll("SELECT * FROM activity ORDER BY created_at DESC LIMIT 5");?>
    <!-- Notifications and Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Recent Notifications -->

      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-xl font-bold text-gray-800">Recent Notifications</h2>
          <a href="notifications.php" class="text-indigo-600 text-sm font-medium hover:underline">View all</a>
        </div>

        
        <div class="space-y-4">
          <?php if (empty($notify)): ?>
            <p class="text-gray-500">No notifications available.</p>
          <?php endif; ?>
        <?php foreach($notify as $notification): ?>

          <div class="flex items-start">
            <?php if($notification['category'] == 'assigment'): ?>
            <div class="bg-indigo-100 p-2 rounded-full mr-4">
              <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
            </div>
            <?php else: ?>
            <div class="bg-green-100 p-2 rounded-full mr-4">
              <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <?php endif; ?>
            <?php $descrotption = explode(',',$notification['descrotption']) ?>
            <div>
              <p class="font-medium"> <?php echo $descrotption[0] ?> <span class="text-indigo-600"><?php echo $descrotption[1] ?></span></p>
              <?php
            $created_at = new DateTime($notification['created_at']);
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
      </div>


      <!-- Team Activity -->
      <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-xl font-bold text-gray-800">Team Activity</h2>
          <a href="team.php" class="text-indigo-600 text-sm font-medium hover:underline">View team</a>
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

      </div>
    </div>
  </div>
</body>
</html>