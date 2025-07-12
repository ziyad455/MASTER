<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Password | Hotel Reservation</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-300 min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-md">
    <div class="bg-white/80 rounded-xl shadow-lg border border-blue-200">
      <div class="p-8">
        <div class="text-center mb-8">
          <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-4 text-blue-600">
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
          </div>
          <h2 class="text-2xl font-bold text-blue-700 mb-2">Create Password</h2>
          <p class="text-blue-600">Secure your hotel reservation account</p>
        </div>
        
        <form id="passwordForm" action="../../../backend/controller/user/register/password.php" method="post">
          <div class="mb-6">
            <label for="password" class="block text-blue-700 font-medium mb-2">Password</label>
            <div class="relative">
              <input
                type="password"
                name="password"
                id="password"
                class="w-full px-4 py-3 rounded-lg border border-blue-200 text-gray-700"
                placeholder="Enter your password"
              >
              <button 
                type="button" 
                class="toggle-password absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-blue-600" 
                data-target="password"
              >
                <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                </svg>
              </button>
            </div>
            <div id="password_error" class="text-red-500 text-xs mt-1 hidden"></div>
          </div>
          
          <div class="mb-6">
            <label for="confirm_password" class="block text-blue-700 font-medium mb-2">Confirm Password</label>
            <div class="relative">
              <input
                type="password"
                name="confirm_password"
                id="confirm_password"
                class="w-full px-4 py-3 rounded-lg border border-blue-200 text-gray-700"
                placeholder="Confirm your password"
              >
              <button 
                type="button" 
                class="toggle-password absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-blue-600" 
                data-target="confirm_password"
              >
                <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                </svg>
              </button>
            </div>
            <div id="confirm_password_error" class="text-red-500 text-xs mt-1 hidden"></div>
          </div>
          
          <div class="pt-2">
            <button
              type="submit"
              class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 transition"
            >
              Continue <span class="ml-1">→</span>
            </button>
          </div>
        </form>
        
        <div class="text-center mt-6">
          <p class="text-blue-700 text-sm">
            Already have an account? 
            <a href="/login" class="font-semibold hover:text-blue-800">Sign in</a>
          </p>
        </div>
      </div>
      
      <div class="bg-blue-50/50 px-8 py-4 text-center border-t border-blue-200">
        <p class="text-blue-700 text-xs">
          By continuing, you agree to our <a href="#" class="font-semibold hover:underline">Terms</a> and <a href="#" class="font-semibold hover:underline">Privacy Policy</a>
        </p>
      </div>
    </div>
    
    <!-- Progress Indicator -->
    <div class="mt-8 flex justify-center">
      <div class="flex space-x-2">
        <div class="w-6 h-1.5 rounded-full bg-blue-600"></div>
        <div class="w-6 h-1.5 rounded-full bg-blue-600"></div>
        <div class="w-6 h-1.5 rounded-full bg-blue-600"></div>
      </div>
    </div>
  </div>

  <script src="../../helper/js/user/pasword.js"></script>

  </script>
</body>
</html>