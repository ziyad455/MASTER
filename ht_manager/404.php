<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | LuxStay Hotels</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .error-number {
            font-size: 12rem;
            line-height: 1;
            background: linear-gradient(45deg, #fff, #e0e7ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 8px 32px rgba(255, 255, 255, 0.3);
        }

        @media (max-width: 768px) {
            .error-number {
                font-size: 8rem;
            }
        }

        @media (max-width: 480px) {
            .error-number {
                font-size: 6rem;
            }
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-purple-600 via-blue-600 to-indigo-800 text-white overflow-x-hidden">
    <!-- Floating Background Shapes -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/12 opacity-10">
            <i class="fas fa-bed text-6xl text-white"></i>
        </div>
        <div class="absolute top-3/5 right-1/12 opacity-10">
            <i class="fas fa-key text-4xl text-white"></i>
        </div>
        <div class="absolute bottom-1/5 left-1/5 opacity-10">
            <i class="fas fa-concierge-bell text-5xl text-white"></i>
        </div>
        <div class="absolute top-1/12 right-1/3 opacity-10">
            <i class="fas fa-door-open text-4xl text-white"></i>
        </div>
    </div>

    <!-- Header -->
    <header class="relative z-10 p-4 lg:p-8">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-800 rounded-full flex items-center justify-center">
                <i class="fas fa-hotel text-white text-xl"></i>
            </div>
            <span class="font-bold text-xl text-white tracking-wide text-shadow">LuxStay Hotels</span>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center px-4 py-8 relative z-5">
        <div class="text-center max-w-2xl mx-auto">
            <!-- 404 Number -->
            <div class="error-number font-black mb-4 md:mb-8">
                404
            </div>

            <!-- Title -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 md:mb-6 text-shadow">
                Oops! Room Not Found
            </h1>

            <!-- Message -->
            <p class="text-lg md:text-xl mb-8 md:mb-12 opacity-90 leading-relaxed px-4">
                It looks like the page you're looking for has checked out! 
                Don't worry, our concierge is here to help you find your way back to comfort.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <button onclick="goBack()" class="inline-flex items-center gap-2 px-8 py-4 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-full border border-white/30 backdrop-blur-sm transition-all duration-300 transform hover:-translate-y-1 w-full sm:w-auto justify-center">
                    <i class="fas fa-arrow-left"></i>
                    Go Back
                </button>
            </div>

            <!-- Additional Help -->
            <div class="mt-12 pt-8 border-t border-white/20">
                <p class="text-sm opacity-75 mb-4">Need assistance? Our support team is available 24/7</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center text-sm">
                    <a href="tel:+1234567890" class="inline-flex items-center gap-2 text-white/80 hover:text-white transition-colors">
                        <i class="fas fa-phone"></i>
                        Call us: +1 (234) 567-890
                    </a>
                    <a href="mailto:support@luxstay.com" class="inline-flex items-center gap-2 text-white/80 hover:text-white transition-colors">
                        <i class="fas fa-envelope"></i>
                        support@luxstay.com
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="relative z-10 text-center py-6 px-4">
        <p class="text-sm opacity-75">
            © 2024 LuxStay Hotels. All rights reserved. | 
            <a href="/privacy" class="hover:text-blue-300 transition-colors">Privacy Policy</a> | 
            <a href="/terms" class="hover:text-blue-300 transition-colors">Terms of Service</a>
        </p>
    </footer>

    <script>
        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '/';
            }
        }
    </script>
</body>
</html>