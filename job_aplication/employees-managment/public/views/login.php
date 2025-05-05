<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Your Company</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    .gradient-bg {
       background: linear-gradient(135deg, #2563EB, #1E3A8A);}
    .gradient-bg:hover {
      background: linear-gradient(135deg, #1E3A8A, #2563EB);
          }
  </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-md">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
    
      <div class="gradient-bg p-6 text-center">
        <svg class="w-10 h-10 mx-auto text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path>
        </svg>
        <h1 class="text-2xl font-bold text-white mt-4">Welcome Back</h1>
      </div>

     
      <form method="post" action="http://localhost/my-web/employees-managment/app/brain/login_handling.php" class="p-8 space-y-6">
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
          <div class="relative">
            <input 
              type="email" 
              id="email" 
              name="email" 
            
              class="input-control w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition pl-10"
              placeholder="your@email.com">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
            </div>
          </div>
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <div class="relative">
            <input 
              type="password" 
              id="password" 
              name="password" 
             
              class="input-control w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition pl-10"
              placeholder="••••••••">
              <span   
                  id="togglePassword"
                  class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-500 hover:text-blue-500 hidden">
                  <i class="fa-solid fa-eye-slash"></i>
              </span>
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
              </svg>
            </div>
          </div>
          <?php if(isset($_GET['error'])): ?>
            <div class="text-red-500 text-sm mt-2">
              <?php echo htmlspecialchars($_GET['error']);
                    $_GET['error'] = null; ?>
            </div>

          <?php endif; ?>
          <div class="flex justify-end mt-2">
            <a href="#" class="text-sm text-blue-600 hover:text-blue-500">Forgot password?</a>
          </div>
        </div>

        <div>
          <button type="submit" class="w-full gradient-bg hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-medium transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Sign In
          </button>
        </div>
      </form>

    
      <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 text-center">
        <p class="text-sm text-gray-600">Don't have an account? <a href="http://localhost/my-web/employees-managment/public/views/signup.php" class="text-blue-600 hover:text-blue-500 font-medium">Sign up</a></p>
      </div>
    </div>
  </div>
  <script src="http://localhost/my-web/EMPLOYEES-MANAGMENT/public/assist/js/login.js"></script>
</body>
</html>