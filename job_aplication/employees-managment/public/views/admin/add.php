<?php require("nav.php");
 require (str_replace('\\', '/', 'C:\xampp\htdocs\my-web\employees-managment\app\database\conectdb.php'));
 if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  header("Location: http://localhost/my-web/EMPLOYEES-MANAGMENT/404.php");
  exit();
}
 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Task</title>

  <link rel="stylesheet" href="/my-web/EMPLOYEES-MANAGMENT/public/assist/css/admin/tasks/add.css">
</head>
<body class="bg-gray-50">
  <div class="container mx-auto px-4 py-8 max-w-3xl">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
      
      <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-6">
        <h1 class="text-2xl font-bold text-white">Add New Task</h1>
      </div>

      
      <form method="POST" action="http://localhost/my-web\employees-managment\app\brain\admin\tasks\add_handling.php" class="p-8 space-y-6">
        
        <div>
          <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Task Title</label>
          <input 
            type="text" 
            id="title" 
            name="title" 
           
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
            placeholder="Enter task title">
        </div>

       
        <div>
          <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description (Optional)</label>
          <textarea 
            id="description" 
            name="description" 
            rows="4"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
            placeholder="Task details..."></textarea>
        </div>

        <!-- Due Date -->
        <div>
          <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
          <input 
            type="date" 
            id="due_date" 
            name="due_date" 
            required
            value="<?php echo date('Y-m-d'); ?>"
            min="<?php echo date('Y-m-d'); ?>"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

      
        <div>
          <label for="assigned_to" class="block text-sm font-medium text-gray-700 mb-1">Assign To</label>
          <select 
            id="assigned_to" 
            name="assigned_to"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            <option value="" disabled selected>Select employee</option>
            <?php
          $employees = $db->selectALL("SELECT u.id, u.name FROM users u JOIN employees e ON u.id = e.user_id WHERE u.role = 'employee'");

          foreach($employees as $employee) {
              echo "<option value='{$employee['id']}'>" . strtoupper($employee['name']) . "</option>";
          }
?>

          </select>
        </div>
        <?php if (isset($_GET['success']) && $_GET['success'] === 'success' ): ?>
          <div class="text-green-600 text-sm font-medium mt-2">
            Task created successfully!
          </div>
        <?php elseif (isset($_GET['error']) && $_GET['error'] === 'faild'): ?>
          <div class="text-red-600 text-sm font-medium mt-2">
            Error creating task. Please try again.
          </div>
     <?php endif; ?>

        
        <div class="flex justify-end space-x-4 pt-4">
          <button 
            type="submit" 
            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Create Task
          </button>
          <a 
            href="tasks.php" 
            class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
  <script src="http://localhost/my-web/EMPLOYEES-MANAGMENT/public/assist/js/admin/add.js"></script>
</body>
</html>