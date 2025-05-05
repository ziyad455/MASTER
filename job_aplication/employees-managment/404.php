
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page Not Found | Your Company</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>

@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); }
}

.text-indigo-600 {
  animation: pulse 2s infinite;
}


.bg-indigo-600:hover {
  transform: translateY(-1px);
  box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
  transition: all 0.2s ease;
}

.bg-white:hover {
  transform: translateY(-1px);
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  transition: all 0.2s ease;
}


@media (max-width: 640px) {
  .text-6xl {
    font-size: 4rem;
  }
  
  .text-3xl {
    font-size: 2rem;
  }
  
  .flex-col {
    gap: 1rem;
  }
}
  </style>
</head>
<body class="bg-gray-50">
  <div class="flex flex-col items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="text-center">
      <h1 class="text-6xl font-bold text-indigo-600 mb-4">404</h1>
      <h2 class="text-3xl font-medium text-gray-900 mb-6">Page Not Found</h2>
      <p class="text-lg text-gray-600 max-w-md mx-auto mb-8">
        The page you're looking for doesn't exist or has been moved.
      </p>
      <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="/" class="px-6 py-3 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 transition-colors">
          Go to Homepage
        </a>
        <a href="javascript:history.back()" class="px-6 py-3 bg-white text-gray-700 font-medium rounded-md border border-gray-300 hover:bg-gray-50 transition-colors">
          Go Back
        </a>
      </div>
    </div>
    <div class="mt-12">
      <svg class="w-64 h-64 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
    </div>
  </div>
</body>
</html>