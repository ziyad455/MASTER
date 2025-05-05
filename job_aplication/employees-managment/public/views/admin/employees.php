<?php require("nav.php"); 
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  header("Location: http://localhost/my-web/EMPLOYEES-MANAGMENT/404.php");
  exit();
}?>

<?php
require (str_replace('\\', '/', 'C:\xampp\htdocs\my-web\employees-managment\app\database\conectdb.php'));

$employees = $db->selectAll("SELECT 
users.id,
users.name, 
users.email, 
users.country, 
employees.salary, 
employees.hire_date
FROM 
users
INNER JOIN 
employees ON users.id = employees.user_id
WHERE 
users.role = 'employee'
ORDER BY 
employees.hire_date DESC;
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employees Management</title>
  <link rel="stylesheet" href="http://localhost/my-web/EMPLOYEES-MANAGMENT/public/assist/css/admin/employees.css">
</head>
<body class="bg-gray-50">
  <div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
      <h1 class="text-3xl font-medium text-gray-800 mb-4 md:mb-0">Employees Management</h1>
      <div class="flex items-center space-x-4">
        <div class="bg-white rounded-lg shadow-sm px-4 py-2">
          <span class="text-gray-500 mr-2">Total Employees:</span>
          <span class="font-medium text-indigo-600"><?php echo count($employees); ?></span>
        </div>

        
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salary</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hire Date</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php foreach ($employees as $employee): ?>
          <tr class="hover:bg-gray-50 transition">
            <!-- Employee Column -->
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                  <span class="text-indigo-600 font-medium">
                    <?php 
                    $names = explode(' ', $employee['name']);
                    echo strtoupper($names[0][0] . (count($names) > 1 ? $names[1][0] : ''));
                    ?>
                  </span>
                </div>
                <div class="ml-4">
                  <div class="text-sm font-medium text-gray-900"><?php echo strtoupper($employee['name'])  ?></div>

                </div>
              </div>
            </td>


            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900"><?php echo $employee['email'] ?></div>
              <div class="text-xs text-gray-500"><?php echo $employee['phone'] ?? 'N/A' ?></div>
            </td>


            <td class="px-6 py-4 whitespace-nowrap">
              <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                <?php echo $employee['country'] ?>
              </span>
            </td>

   
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">$<?php echo number_format($employee['salary'], 2) ?></div>

            </td>


      <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-900">
          <?php echo date('M d, Y', strtotime($employee['hire_date'])); ?>
        </div>
        <div class="text-xs text-gray-500">
          <?php 
            $hireDate = new DateTime($employee['hire_date']);
            $today = new DateTime();
            $interval = $today->diff($hireDate);

            if ($interval->y > 0) {
                echo $interval->y . ' year' . ($interval->y > 1 ? 's' : '');
            } elseif ($interval->m > 0) {
                echo $interval->m . ' month' . ($interval->m > 1 ? 's' : '');
            } else {
                echo $interval->d . ' day' . ($interval->d > 1 ? 's' : '');
            }
          ?> with company
        </div>
    </td>




          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  


</body>
</html>