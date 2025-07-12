<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: ../core/guist.php");
    exit();
}
?>
 <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../helper/css/admin.css">
  </head>
  <body>
    
    <div class="sidebar">
        <div class="p-6 border-b border-white border-opacity-20">
            <h1 class="text-2xl font-bold text-white">
                <i class="fas fa-crown mr-2"></i>
                Hotel Admin
            </h1>
        </div>
        
        <nav class="pt-6">
            <div class="sidebar-item active" data-page="dashboard">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </div>
            <div class="sidebar-item" data-page="rooms">
                <i class="fas fa-bed mr-3"></i>
                Room Management
            </div>
            <div class="sidebar-item" data-page="bookings">
                <i class="fas fa-calendar-check mr-3"></i>
                Booking Status
            </div>
            <div class="sidebar-item" data-page="add-room">
                <i class="fas fa-plus mr-3"></i>
                Add New Room
            </div>
        </nav>
        
        <div class="absolute bottom-6 left-6 right-6">
    <div class="flex items-center">
          <a href="../../backend/controller/core/logout.php" class="nav-link px-4 py-2 rounded-lg font-medium text-red-100 bg-red-500 transition">
            <i class="fas fa-sign-out-alt mr-2"></i>Logout
          </a>
        </div>
            <div class="text-white mt-6 text-opacity-60 text-sm">
                <i class="fas fa-user-shield mr-2"></i>
                Admin Panel v1.0
            </div>
        </div>
    </div>
  </body>
  </html>
    