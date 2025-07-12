<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Reservation | Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-300 min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-md">
    <!-- Hotel Logo Area -->
    <div class="text-center mb-6">
      <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-3">
        <svg class="w-8 h-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5m-4 0h4" />
        </svg>
      </div>
      <h1 class="text-3xl font-semibold text-blue-800">Luxury Stays</h1>
    </div>
    
    <div class="bg-white/80 rounded-xl shadow-lg border border-blue-200">
      <div class="p-8">
        <div class="text-center mb-8">
          <h2 class="text-2xl font-semibold text-blue-700 mb-2">Start Your Reservation</h2>
          <p class="text-blue-600">Enter your email to continue</p>
        </div>
        
        <form id="emailForm" action="../../../backend/controller/user/register/email.php" method="post">
          <div class="mb-2">
            <label for="email" class="block text-blue-700 font-medium mb-2">Email Address</label>
            <input
              type="email"
              name="email"
              id="email"
              required
              class="w-full px-4 py-3 rounded-lg border border-blue-200 text-gray-700"
              placeholder="guest@example.com"
            >
          </div>
          <div id="email-error" class="text-red-500 text-sm mb-4 hidden"></div>
          <div class="text-red-500 text-sm mb-4 ">
            <?php
              session_start();
              if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
              }
            ?>
            </div>
          
          <button
            type="submit"
            class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
          >
            Continue <span class="ml-1">→</span>
          </button>
        </form>
        
        <div class="mt-6 text-center">
          <p class="text-blue-700 text-sm">
            Already have an account? 
            <a href="/login" class="font-semibold">Sign in</a>
          </p>
        </div>
      </div>
      
      <div class="bg-blue-50/50 px-8 py-4 text-center border-t border-blue-200">
        <p class="text-blue-700 text-xs">
          By continuing, you agree to our <a href="#" class="font-semibold">Terms</a> and <a href="#" class="font-semibold">Privacy Policy</a>
        </p>
      </div>
    </div>
    
    <!-- Progress Indicator -->
    <div class="mt-8 flex justify-center">
      <div class="flex space-x-2">
                <div class="w-6 h-1.5 rounded-full bg-blue-600"></div>
                <div class="w-6 h-1.5 rounded-full bg-blue-600"></div>
                <div class="w-6 h-1.5 rounded-full bg-blue-200"></div>
      </div>
    </div>
  </div>

  <script src="../../helper/js/user/email.js"> 

  </script>
</body>
</html>