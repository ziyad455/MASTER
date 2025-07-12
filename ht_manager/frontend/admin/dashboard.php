<?php   
require "../../backend/database/conectdb.php";  
$nbr_rooms = $db->selectOne("SELECT COUNT(*) AS total FROM chambres"); 
$active = $db->selectOne("SELECT COUNT(*) AS active from chambres where status = ? ",["not_availble"]) ;  
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../helper/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .stats-animation {
            animation: fadeInUp 0.6s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .admin-card {
            transition: box-shadow 0.2s ease;
            border: 1px solid #e5e7eb;
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .admin-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .pulse-icon {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .hotel-illustration {
            width: 100%;
            max-width: 400px;
            height: 200px;
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%);
            border-radius: 15px;
            position: relative;
            overflow: hidden;
            margin: 20px auto;
        }
        
        .hotel-building {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 70%;
            background: #2c3e50;
            border-radius: 5px 5px 0 0;
        }
        
        .hotel-roof {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            height: 20px;
            background: #e74c3c;
            clip-path: polygon(0 100%, 50% 0%, 100% 100%);
        }
        
        .hotel-windows {
            position: absolute;
            top: 25%;
            left: 15%;
            width: 70%;
            height: 60%;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(3, 1fr);
            gap: 8px;
        }
        
        .window {
            background: #f39c12;
            border-radius: 2px;
            opacity: 0.9;
        }
        
        .window:nth-child(odd) {
            animation: windowBlink 3s infinite alternate;
        }
        
        @keyframes windowBlink {
            0%, 50% { opacity: 0.9; }
            51%, 100% { opacity: 0.3; }
        }
        
        .cloud {
            position: absolute;
            background: white;
            border-radius: 50px;
            opacity: 0.8;
            animation: float 6s ease-in-out infinite;
        }
        
        .cloud1 {
            width: 50px;
            height: 20px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .cloud2 {
            width: 40px;
            height: 15px;
            top: 15%;
            right: 15%;
            animation-delay: 2s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .progress-ring {
            width: 120px;
            height: 120px;
        }
        
        .progress-circle {
            stroke: #e6e6e6;
            stroke-width: 8;
            fill: transparent;
            r: 52;
            cx: 60;
            cy: 60;
        }
        
        .progress-bar {
            stroke: #4f46e5;
            stroke-width: 8;
            fill: transparent;
            r: 52;
            cx: 60;
            cy: 60;
            stroke-dasharray: 327;
            stroke-dashoffset: 327;
            transform: rotate(-90deg);
            transform-origin: 60px 60px;
            animation: progressAnimation 2s ease-in-out;
        }
        
        @keyframes progressAnimation {
            from { stroke-dashoffset: 327; }
            to { stroke-dashoffset: 98; } /* 70% progress */
        }
    </style>
</head>
<body>
    <section id="dashboard" class="page-section active p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="admin-card stats-animation">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Total Rooms</p>
                            <p class="text-3xl font-bold text-gray-900"><?= $nbr_rooms['total'] ?></p>
                        </div>
                        <div class="bg-blue-50 p-4 rounded-xl">
                            <i class="fas fa-bed text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="admin-card stats-animation" style="animation-delay: 0.1s;">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Active Bookings</p>
                            <p class="text-3xl font-bold text-gray-900"><?= $active['active'] ?></p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-xl">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="admin-card stats-animation" style="animation-delay: 0.2s;">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Pending</p>
                            <p class="text-3xl font-bold text-gray-900">3</p>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-xl">
                            <i class="fas fa-clock text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Welcome Card with Hotel Illustration -->
        <div class="admin-card mb-8">
            <div class="bg-gradient-to-r from-blue-50 to-green-50 p-8 rounded-xl">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div class="text-center lg:text-left">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">
                            <i class="fas fa-hotel mr-2 text-blue-600"></i>
                            Welcome to Hotel Management
                        </h2>
                        <p class="text-lg text-gray-700 mb-4 font-medium">"A well-managed hotel is a guest's second home."</p>
                        <p class="text-gray-600 mb-6">Keep your rooms updated and monitor bookings to ensure every guest has a smooth stay.</p>
                        <div class="flex flex-wrap gap-3 justify-center lg:justify-start">
                            <span class="inline-flex items-center bg-white text-blue-700 px-4 py-2 rounded-full font-medium shadow-sm border">
                                <i class="fas fa-chart-line mr-2 text-sm"></i> Stay Organized
                            </span>
                            <span class="inline-flex items-center bg-white text-green-700 px-4 py-2 rounded-full font-medium shadow-sm border">
                                <i class="fas fa-eye mr-2 text-sm"></i> Monitor in Real Time
                            </span>
                            <span class="inline-flex items-center bg-white text-yellow-700 px-4 py-2 rounded-full font-medium shadow-sm border">
                                <i class="fas fa-star mr-2 text-sm"></i> Deliver Excellence
                            </span>
                        </div>
                    </div>
                    
                    <!-- Hotel Illustration -->
                    <div class="flex justify-center">
                        <div class="hotel-illustration">
                            <div class="cloud cloud1"></div>
                            <div class="cloud cloud2"></div>
                            <div class="hotel-building">
                                <div class="hotel-roof"></div>
                                <div class="hotel-windows">
                                    <div class="window"></div>
                                    <div class="window"></div>
                                    <div class="window"></div>
                                    <div class="window"></div>
                                    <div class="window"></div>
                                    <div class="window"></div>
                                    <div class="window"></div>
                                    <div class="window"></div>
                                    <div class="window"></div>
                                    <div class="window"></div>
                                    <div class="window"></div>
                                    <div class="window"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Progress Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Quick Actions -->
            <div class="admin-card">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">
                        <i class="fas fa-bolt text-yellow-500 mr-2"></i>Quick Actions
                    </h3>
                    <div class="space-y-3">
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-lg flex items-center justify-center transition-colors duration-200 font-medium">
                            <i class="fas fa-plus mr-2"></i> Add New Room
                        </button>
                        <button class="w-full bg-green-600 hover:bg-green-700 text-white p-4 rounded-lg flex items-center justify-center transition-colors duration-200 font-medium">
                            <i class="fas fa-calendar-check mr-2"></i> View Bookings
                        </button>
                        <button class="w-full bg-purple-600 hover:bg-purple-700 text-white p-4 rounded-lg flex items-center justify-center transition-colors duration-200 font-medium">
                            <i class="fas fa-chart-bar mr-2"></i> Generate Report
                        </button>
                    </div>
                </div>
            </div>

            <!-- Occupancy Progress -->
            <div class="admin-card">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">
                        <i class="fas fa-percentage text-blue-500 mr-2"></i>Hotel Occupancy
                    </h3>
                    <div class="flex justify-center mb-6">
                        <svg class="progress-ring">
                            <circle class="progress-circle"></circle>
                            <circle class="progress-bar"></circle>
                            <text x="60" y="65" text-anchor="middle" font-size="18" font-weight="bold" fill="#4f46e5">70%</text>
                        </svg>
                    </div>
                    <p class="text-gray-600 mb-6">Current occupancy rate looks great!</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg border">
                            <div class="text-sm font-medium text-gray-600 mb-1">Occupied</div>
                            <div class="text-xl text-blue-600 font-bold"><?= $active['active'] ?></div>
                            <div class="text-xs text-gray-500">rooms</div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg border">
                            <div class="text-sm font-medium text-gray-600 mb-1">Available</div>
                            <div class="text-xl text-green-600 font-bold"><?= $nbr_rooms['total'] - $active['active'] ?></div>
                            <div class="text-xs text-gray-500">rooms</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Timeline -->
        <div class="admin-card">
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-6">
                    <i class="fas fa-clock text-green-500 mr-2"></i>Recent Activity
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <div class="bg-blue-500 p-3 rounded-full mr-4 flex-shrink-0">
                            <i class="fas fa-user-plus text-white text-sm"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-800">New booking received</p>
                            <p class="text-sm text-gray-600">Room 205 - Check-in: Today</p>
                        </div>
                        <span class="text-xs text-gray-500 flex-shrink-0">2 min ago</span>
                    </div>
                    
                    <div class="flex items-center p-4 bg-green-50 rounded-lg border border-green-100">
                        <div class="bg-green-500 p-3 rounded-full mr-4 flex-shrink-0">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-800">Room cleaning completed</p>
                            <p class="text-sm text-gray-600">Room 102 is ready for guests</p>
                        </div>
                        <span class="text-xs text-gray-500 flex-shrink-0">15 min ago</span>
                    </div>
                    
                    <div class="flex items-center p-4 bg-yellow-50 rounded-lg border border-yellow-100">
                        <div class="bg-yellow-500 p-3 rounded-full mr-4 flex-shrink-0">
                            <i class="fas fa-exclamation text-white text-sm"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-gray-800">Maintenance request</p>
                            <p class="text-sm text-gray-600">Room 308 - AC issue reported</p>
                        </div>
                        <span class="text-xs text-gray-500 flex-shrink-0">1 hour ago</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>