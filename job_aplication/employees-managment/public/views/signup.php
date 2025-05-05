<?php 
session_start();
session_destroy();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Application Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="http://localhost/my-web/EMPLOYEES-MANAGMENT/public/assist/css/signup.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-2xl">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
      <div class="gradient-bg p-6">
        <h1 class="text-2xl font-bold text-white text-center">Job Application Form</h1>
      </div>
      
      <form action="http://localhost/my-web/employees-managment/app/brain/signup_handling.php" method="post" class="p-6 space-y-6" enctype="multipart/form-data" id="application-form">
   
        <div>
          <h2 class="text-lg font-semibold text-gray-800 mb-4 gradient-text">Personal Information</h2>
          <div class="space-y-4">
      
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
              <input  type="text" name="name" id="name" placeholder="Enter your full name"  value="<?php echo htmlspecialchars($_GET['old']['name'] ?? ''); ?>"
                     class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition input-control ">
              <div class="error hidden"></div>
            </div>
            
      
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
              <input type="email" name="email" id="email" placeholder="Enter your email"  value="<?php echo htmlspecialchars($_GET['old']['email'] ?? ''); ?>"
                     class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition input-control">
              <div class="error hidden mt-3 "></div>
              <div class="error mt-3 <?php echo isset($_SESSION['errors']['email'])? '' : 'hidden'?>"> <?php echo $_SESSION['errors']['email'] ?? ""; ?> </div>

            </div>
            
         
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div >
              <div class="relative">
              <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
              <input type="password" name="password" id="password" placeholder="Create a password" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition input-control">
              
           
              <span id="togglePassword"
                    class="absolute inset-y-0 right-3 top-5 flex items-center cursor-pointer hidden text-gray-500 hover:text-blue-500">
                <i class="fa-solid fa-eye-slash"></i>
              </span>
              </div>


              <div class="error hidden"></div>
         </div>

              <div>
                <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition input-control">
                <div class="error hidden"></div>
              </div>
            </div>
            
    
            <div>
              <label for="countries" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
              <select name="country" id="countries"  
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition input-control">
                <option value="" selected disabled>Select your country</option>



              </select>
              <div class="error hidden"></div>
            </div>
          </div>
        </div>
        
        
        <div>
          <h2 class="text-lg font-semibold text-gray-800 mb-4 gradient-text">Job Details </h2>
          <div class="space-y-4">
            
            <div>
              <label for="job_requist" class="block text-sm font-medium text-gray-700 mb-1">Job Request</label>
              <textarea name="job_requist" id="job_requist" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="Please describe the job you're requesting, including any specific requirements or details (optional)"></textarea>
            </div>
            
            <div>
            <label for="cv" id="cv-upload-label" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition has-file:border-blue-500 has-file:bg-blue-50">
                <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-instructions">
                    <svg class="w-8 h-8 mb-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500">PDF, DOC, DOCX (MAX. 5MB)</p>
                  </div>
                <div id="file-selected" class="hidden items-center justify-center p-4">
                    <svg class="w-6 h-6 mr-2 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700" id="file-name">File selected</span>
                </div>
                <input id="cv" name="cv" type="file" class="input-control sr-only focusable mb-3" accept=".pdf,.doc,.docx">
                <div class="error hidden mt-3 "> <?php echo $_SESSION['errors']['cv'] ?? ""; ?> </div>
           </label>

        
           

            </div>
          </div>
        </div>
        
      
        <div class="pt-4">
          <button type="submit"  name="submit" id="submit"
                  class="w-full gradient-bg text-white py-3 px-4 rounded-lg font-medium hover:opacity-90 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 block">
            Submit Application
          </button>
          <a href="http://localhost/my-web/employees-managment/public/views/login.php" 
            class="text-blue-600 hover:text-blue-800 underline text-center mt-4 block">
            Already filled the form?
          </a>
  
        </div>
      </form>
    </div>
  </div>
  <script src="http://localhost/my-web/EMPLOYEES-MANAGMENT/public/assist/js/signup.js"></script>
</body>
</html>