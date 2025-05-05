

<?php session_start();?>
 


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application Received | Your Company</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="http://localhost/my-web/EMPLOYEES-MANAGMENT/public/assist/css/employee/waiting_room.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
  <div class="max-w-2xl w-full">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">

      <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-6 text-center">
        <svg class="w-16 h-16 mx-auto text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <h1 class="text-2xl font-bold text-white mt-4">Application Received!</h1>
      </div>


      <div class="p-8 space-y-6">
        <div class="text-center">
          <h2 class="text-xl font-semibold text-gray-800">Thank you, <?php echo "<b>".strtoupper($_SESSION['user']['name'])."</b>" ?></h2>
          <p class="text-gray-600 mt-2">We've received your job request and will review it shortly.</p>
        </div>

        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
          <div class="flex">
            <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="ml-3">
              <h3 class="text-sm font-medium text-blue-800">What happens next?</h3>
              <div class="mt-2 text-sm text-blue-700">
                <p>• Our team will review your CV and qualifications</p>
                <p>• You'll receive an email within 3-5 business days</p>
                <p>• We may contact you for additional information</p>
              </div>
            </div>
          </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-center gap-4 pt-4">
          <a href="#" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            View Your Application
          </a>
          <a href="http://localhost/my-web/employees-managment/public/views/login.php" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Return to login Page
          </a>
        </div>
      </div>

   
      <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
        <div class="text-center text-sm text-gray-500">
          <p>Questions? Contact us at <a href="mailto:hr@yourcompany.com" class="text-blue-600 hover:text-blue-500">hr@yourcompany.com</a></p>
          <p class="mt-1">© 2025 Ziyad Tber. All rights reserved.</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>