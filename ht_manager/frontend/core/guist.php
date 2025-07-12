<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 30%, #60a5fa 60%, #f8fafc 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        

        
        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }
        
        @keyframes pulse-glow {
            from { box-shadow: 0 0 20px rgba(59, 130, 246, 0.4); }
            to { box-shadow: 0 0 40px rgba(59, 130, 246, 0.8); }
        }
        
        .swiper-pagination-bullet {
            background: white !important;
            opacity: 0.5 !important;
        }
        
        .swiper-pagination-bullet-active {
            opacity: 1 !important;
            background: #3b82f6 !important;
        }
        
        .swiper-button-next, .swiper-button-prev {
            color: white !important;
        }
        
        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .btn-3d {
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.3s ease;
        }
        
        .btn-3d:hover {
            transform: rotateX(10deg) rotateY(10deg);
        }
        
        .stats-counter {
            font-size: 2.5rem;
            font-weight: 700;
            color: #3b82f6;
        }
        
        .feature-icon {
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .image-overlay {
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.1));
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 min-h-screen overflow-x-hidden">

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-effect">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-800 rounded-full flex items-center justify-center floating-animation">
                        <i class="fas fa-hotel text-white text-xl"></i>
                    </div>
                    <span class="font-bold text-xl text-white tracking-wide text-shadow">LuxStay Hotels</span>
                </div>

                <div class="flex space-x-3">
                    <a href="login.php" class="px-6 py-2 rounded-full bg-white text-blue-700 font-semibold hover:bg-blue-50 shadow-lg transition btn-3d">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                    <a href="../user/register/name.php" class="px-6 py-2 rounded-full border-2 border-white text-white font-semibold hover:bg-white hover:text-blue-700 transition btn-3d">
                        <i class="fas fa-user-plus mr-2"></i>Register
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient min-h-screen flex items-center pt-20">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-white space-y-8">
                    <div class="space-y-4">
                        <h1 class="text-5xl lg:text-7xl font-bold leading-tight text-shadow">
                            Experience
                            <span class="block bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">
                                Luxury
                            </span>
                            Like Never Before
                        </h1>
                        <p class="text-xl lg:text-2xl text-blue-100 max-w-2xl">
                            Discover our world-class hospitality with state-of-the-art facilities and unmatched service excellence.
                        </p>
                    </div>

                    <!-- Features Grid -->
                    <div class="grid grid-cols-2 gap-6">
                        <div class="glass-effect p-4 rounded-xl card-hover">
                            <i class="fas fa-concierge-bell text-3xl text-yellow-400 mb-2"></i>
                            <h3 class="font-semibold text-lg">24/7 Concierge</h3>
                            <p class="text-blue-200 text-sm">Premium service anytime</p>
                        </div>
                        <div class="glass-effect p-4 rounded-xl card-hover">
                            <i class="fas fa-spa text-3xl text-green-400 mb-2"></i>
                            <h3 class="font-semibold text-lg">Wellness Spa</h3>
                            <p class="text-blue-200 text-sm">Rejuvenate your senses</p>
                        </div>
                        <div class="glass-effect p-4 rounded-xl card-hover">
                            <i class="fas fa-utensils text-3xl text-red-400 mb-2"></i>
                            <h3 class="font-semibold text-lg">Fine Dining</h3>
                            <p class="text-blue-200 text-sm">Michelin-starred cuisine</p>
                        </div>
                        <div class="glass-effect p-4 rounded-xl card-hover">
                            <i class="fas fa-swimming-pool text-3xl text-cyan-400 mb-2"></i>
                            <h3 class="font-semibold text-lg">Infinity Pool</h3>
                            <p class="text-blue-200 text-sm">Stunning city views</p>
                        </div>
                    </div>


                </div>

                <!-- Right Content - Image Slider -->
                <div class="relative">
                    <div class="swiper hotel-swiper rounded-2xl overflow-hidden shadow-2xl">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="relative h-96 lg:h-[500px]">
                                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=800&q=80" 
                                         alt="Luxury Hotel Suite" 
                                         class="w-full h-full object-cover">
                                    <div class="absolute inset-0 image-overlay"></div>
                                    <div class="absolute bottom-6 left-6 text-white">
                                        <h3 class="text-2xl font-bold mb-2">Presidential Suite</h3>
                                        <p class="text-lg">Ultimate luxury with panoramic views</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="relative h-96 lg:h-[500px]">
                                    <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=800&q=80" 
                                         alt="Hotel Lobby" 
                                         class="w-full h-full object-cover">
                                    <div class="absolute inset-0 image-overlay"></div>
                                    <div class="absolute bottom-6 left-6 text-white">
                                        <h3 class="text-2xl font-bold mb-2">Grand Lobby</h3>
                                        <p class="text-lg">Elegant design meets modern comfort</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="relative h-96 lg:h-[500px]">
                                    <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=800&q=80" 
                                         alt="Hotel Restaurant" 
                                         class="w-full h-full object-cover">
                                    <div class="absolute inset-0 image-overlay"></div>
                                    <div class="absolute bottom-6 left-6 text-white">
                                        <h3 class="text-2xl font-bold mb-2">Signature Restaurant</h3>
                                        <p class="text-lg">Award-winning culinary experience</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="relative h-96 lg:h-[500px]">
                                    <img src="https://images.unsplash.com/photo-1544986581-efac024faf62?auto=format&fit=crop&w=800&q=80" 
                                         alt="Hotel Pool" 
                                         class="w-full h-full object-cover">
                                    <div class="absolute inset-0 image-overlay"></div>
                                    <div class="absolute bottom-6 left-6 text-white">
                                        <h3 class="text-2xl font-bold mb-2">Rooftop Pool</h3>
                                        <p class="text-lg">Infinity pool with breathtaking views</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="relative h-96 lg:h-[500px]">
                                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=800&q=80" 
                                         alt="Hotel Spa" 
                                         class="w-full h-full object-cover">
                                    <div class="absolute inset-0 image-overlay"></div>
                                    <div class="absolute bottom-6 left-6 text-white">
                                        <h3 class="text-2xl font-bold mb-2">Luxury Spa</h3>
                                        <p class="text-lg">Wellness and relaxation sanctuary</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="space-y-2">
                    <div class="stats-counter" data-target="500">0</div>
                    <p class="text-gray-600 font-medium">Luxury Rooms</p>
                </div>
                <div class="space-y-2">
                    <div class="stats-counter" data-target="50000">0</div>
                    <p class="text-gray-600 font-medium">Happy Guests</p>
                </div>
                <div class="space-y-2">
                    <div class="stats-counter" data-target="25">0</div>
                    <p class="text-gray-600 font-medium">Years Experience</p>
                </div>
                <div class="space-y-2">
                    <div class="stats-counter" data-target="5">0</div>
                    <p class="text-gray-600 font-medium">Star Rating</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gradient-to-br from-blue-50 to-blue-100">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-4">Why Choose LuxStay?</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Experience unparalleled luxury with our world-class amenities and personalized service</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Secure Booking</h3>
                    <p class="text-gray-600">Advanced encryption and secure payment processing for your peace of mind</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-700 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">24/7 Support</h3>
                    <p class="text-gray-600">Round-the-clock assistance for all your needs and requirements</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-700 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-star text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Premium Quality</h3>
                    <p class="text-gray-600">Exceptional standards in every aspect of your stay experience</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-700 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Prime Location</h3>
                    <p class="text-gray-600">Strategically located near major attractions and business districts</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-700 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-wifi text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">High-Speed WiFi</h3>
                    <p class="text-gray-600">Complimentary ultra-fast internet throughout the property</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-cyan-700 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-car text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Valet Parking</h3>
                    <p class="text-gray-600">Complimentary valet parking service for all our guests</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-gradient-to-r from-blue-600 via-blue-500 to-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6 text-shadow">Ready to Experience Luxury?</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">Join thousands of satisfied guests who have made LuxStay their preferred choice for luxury accommodation</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="register.php" class="px-10 py-4 bg-white text-blue-700 font-bold rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 btn-3d pulse-glow">
                    <i class="fas fa-user-plus mr-3"></i>
                    Create Account
                </a>
                <a href="login.php" class="px-10 py-4 border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-blue-700 transition-all duration-300 btn-3d">
                    <i class="fas fa-sign-in-alt mr-3"></i>
                    Login Now
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-hotel text-white"></i>
                        </div>
                        <span class="font-bold text-xl">LuxStay Hotels</span>
                    </div>
                    <p class="text-gray-400">Experience luxury and comfort at our world-class hotels with exceptional service and premium amenities.</p>
                </div>
                
                <div>
                    <h3 class="font-bold text-lg mb-4">Quick Links</h3>
                    <div class="space-y-2">
                        <a href="#" class="block text-gray-400 hover:text-white transition">Home</a>
                        <a href="#" class="block text-gray-400 hover:text-white transition">Rooms</a>
                        <a href="#" class="block text-gray-400 hover:text-white transition">Services</a>
                        <a href="#" class="block text-gray-400 hover:text-white transition">Contact</a>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-bold text-lg mb-4">Services</h3>
                    <div class="space-y-2">
                        <a href="#" class="block text-gray-400 hover:text-white transition">Room Service</a>
                        <a href="#" class="block text-gray-400 hover:text-white transition">Spa & Wellness</a>
                        <a href="#" class="block text-gray-400 hover:text-white transition">Fine Dining</a>
                        <a href="#" class="block text-gray-400 hover:text-white transition">Event Planning</a>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-bold text-lg mb-4">Connect With Us</h3>
                    <div class="flex space-x-4 mb-4">
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center hover:bg-blue-500 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center hover:bg-pink-700 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-700 rounded-full flex items-center justify-center hover:bg-blue-800 transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                    <p class="text-gray-400 text-sm">Follow us for updates and exclusive offers</p>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Ziyad and mouad Hotels. All rights reserved. | Privacy Policy | Terms of Service</p>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Swiper
        const swiper = new Swiper('.hotel-swiper', {
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true,
            },
        });

        // Animate stats counters
        function animateCounters() {
            const counters = document.querySelectorAll('.stats-counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const increment = target / 100;
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = target.toLocaleString();
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current).toLocaleString();
                    }
                }, 30);
            });
        }

        // Intersection Observer for animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.classList.contains('stats-counter')) {
                        animateCounters();
                        observer.unobserve(entry.target);
                    }
                }
            });
        });

        // Observe stats section
        document.querySelectorAll('.stats-counter').forEach(counter => {
            observer.observe(counter);
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

   
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 100) {
                nav.classList.add('bg-blue-900/90');
            } else {
                nav.classList.remove('bg-blue-900/90');
            }
        });

        // Add loading animation
        window.addEventListener('load', () => {
            document.body.classList.add('loaded');
        });
    </script>
</body>
</html>