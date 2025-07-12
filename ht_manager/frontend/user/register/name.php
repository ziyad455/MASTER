<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information | Hotel Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-100 to-blue-300 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <div class="bg-white rounded-xl shadow-md border border-blue-100">
            <div class="p-8">
                <div class="text-center mb-8">
          <div class="flex-shrink-0 flex items-center">
            <svg class="h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5m-4 0h4" />
            </svg>
            <span class="ml-2 text-xl font-semibold text-blue-700">Luxury Stays</span>
          </div>
                    

                </div>
                
                <form action="../../../backend/controller/user/register/name.php" method="post" class="space-y-5">
                    <div>
                        <label for="name" class="block text-blue-700 font-medium mb-2">First Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"

                            class="w-full px-4 py-3 rounded-lg border border-blue-200 text-gray-700"
                            placeholder="Enter your first name"
                        >
                        <div id="name_error" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                    
                    <div>
                        <label for="last_name" class="block text-blue-700 font-medium mb-2">Last Name</label>
                        <input
                            type="text"
                            name="last_name"
                            id="last_name"
                            
                            class="w-full px-4 py-3 rounded-lg border border-blue-200 text-gray-700"
                            placeholder="Enter your last name"
                        >
                        <div id="last_name_error" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                    
                    <div class="pt-2">
                        <button
                            type="submit"
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                        >
                            Continue <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>
                
                <div class="text-center mt-6 hev">
                    <p class="text-blue-700 text-sm">
                        Already have an account? 
                        <a href="/login" class="font-semibold ">Sign in</a>
                    </p>
                </div>
            </div>
            
            <div class="bg-blue-50 px-8 py-4 text-center border-t border-blue-200">
                <p class="text-blue-700 text-xs">
                    By continuing, you agree to our <a href="#" class="font-semibold">Terms</a> and <a href="#" class="font-semibold">Privacy Policy</a>
                </p>
            </div>
        </div>
        
        <div class="mt-8 flex justify-center">
            <div class="flex space-x-2">
                <div class="w-6 h-1.5 rounded-full bg-blue-600"></div>
                <div class="w-6 h-1.5 rounded-full bg-blue-200"></div>
                <div class="w-6 h-1.5 rounded-full bg-blue-200"></div>
            </div>
        </div>
    </div>
    <script src="../../helper/js/user/name.js"></script>
</body>
</html>