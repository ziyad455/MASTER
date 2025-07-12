<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Reservation | Welcome Back</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    .messageError {
      color: #EF4444;
      margin-top: 1rem;
      font-size: 0.875rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      background: #FEF2F2;
      padding: 0.75rem;
      border-radius: 0.5rem;
      border: 1px solid #FECACA;
    }
    
    .input-field:focus {
      transform: translateY(-1px);
    }
    
    .login-button:hover {
      transform: translateY(-1px);
    }
  </style>
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
      <p class="text-blue-600 text-lg mt-2">Welcome back! 👋</p>
      <p class="text-blue-500 text-sm mt-1">Sign in to manage your reservations</p>
    </div>

    <!-- Login Form -->
    <div class="bg-white/80 rounded-xl shadow-lg border border-blue-200">
      <div class="p-8">
        <div class="text-center mb-8">
          <h2 class="text-2xl font-semibold text-blue-700 mb-2">Sign In</h2>
          <p class="text-blue-600">Access your account</p>
        </div>
        
        <form action="../../backend/controller/core/LoginControler.php" method="POST" class="space-y-6">
          
          <!-- Email Input -->
          <div class="space-y-2">
            <label for="email" class="block text-blue-700 font-medium mb-2">Email Address</label>
            <input
              type="email"
              name="email"
              id="email"
              required
              class="input-field w-full px-4 py-3 rounded-lg border border-blue-200 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-300 text-gray-700"
              placeholder="guest@example.com"
            >
          </div>

          <!-- Password Input -->
          <div class="space-y-2">
            <label for="password" class="block text-blue-700 font-medium mb-2">Password</label>
            <input
              type="password"
              name="pass"
              id="password"
              required
              class="input-field w-full px-4 py-3 rounded-lg border border-blue-200 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-300 text-gray-700"
              placeholder="Enter your password"
            >
          </div>

          <!-- Login Button -->
          <input
            type="submit"
            value="Sign In"
            name="submit"
            class="login-button w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 cursor-pointer"
          >

          <!-- Error Message -->
          <?php if(isset($_GET['msg'])) : ?>
            <div class="messageError">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-4-6h8a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2v-6a2 2 0 012-2z" />
              </svg>
              <span><?php echo htmlspecialchars($_GET['msg']) ?></span>
            </div>
          <?php endif ?>

          <!-- Forgot Password -->
          <div class="text-center">
            <a href="forgotPass.php" class="text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors">
              Forgot your password?
            </a>
          </div>

        </form>
      </div>
      
      <div class="bg-blue-50/50 px-8 py-4 text-center border-t border-blue-200">
        <p class="text-blue-700 text-sm">
          New to Luxury Stays? 
          <a href="singup/email.php" class="font-semibold hover:text-blue-800 transition-colors">Create an account</a>
        </p>
      </div>
    </div>

    <!-- Progress Indicator -->
    <div class="mt-8 flex justify-center">
      <div class="flex space-x-2">
        <div class="w-6 h-1.5 rounded-full bg-blue-600"></div>
        <div class="w-6 h-1.5 rounded-full bg-blue-200"></div>
        <div class="w-6 h-1.5 rounded-full bg-blue-200"></div>
      </div>
    </div>
  </div>

</body>
</html>