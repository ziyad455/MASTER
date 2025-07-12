<?php
session_start();
require "../../backend/database/conectdb.php"; 

$userId = $_SESSION['user']['id'];


$totalReservations = $db->selectOne("SELECT COUNT(*) FROM reservations WHERE id_user = ?", [$userId])['COUNT(*)'];


$upcomingReservations = $db->selectAll("SELECT * FROM reservations WHERE id_user = ? AND date_debut > NOW()", [$userId]);


$nextReservation = $db->selectOne("SELECT 
  reservations.*, 
  chambres.numero, chambres.type, chambres.superficie, chambres.prix, chambres.image 
  FROM reservations 
  JOIN chambres ON reservations.id_chambre = chambres.id 
  WHERE reservations.id_user = ? AND reservations.date_debut > NOW() 
  ORDER BY reservations.date_debut ASC LIMIT 1", [$userId]);
?>

<!-- Navigation -->
<?php require "nav.php" ?>

<!-- Dashboard Page -->
<div id="dashboard" class="page  flex-grow">
  <main class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
      
      <div class="gradient-bg rounded-2xl p-8 shadow-2xl mb-8 fade-in">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-3xl font-bold text-white">Welcome <?= strtoupper($_SESSION['user']['first_name']); ?></h1>
            <p class="mt-2 text-blue-100 text-lg">
              <?= $nextReservation ? "Your luxury escape awaits - next reservation in " . (new DateTime($nextReservation['date_debut']))->diff(new DateTime())->days . " days" : "No upcoming reservations" ?>
            </p>
          </div>
          <div class="hidden sm:block">
            <button onclick="window.location.href='book.php'" class="bg-white text-blue-600 px-6 py-3 rounded-xl font-semibold hover:bg-blue-50 transition transform hover:scale-105 shadow-lg">
              <i class="fas fa-plus mr-2"></i>Book New Stay
            </button>
          </div>
        </div>
      </div>

   
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Reservations Card -->
        <div class="luxury-card overflow-hidden shadow-lg rounded-2xl card-hover transition fade-in" style="animation-delay: 0.2s">
          <div class="px-6 py-6">
            <div class="flex items-center">
              <div class="flex-shrink-0 bg-blue-100 rounded-xl p-4">
                <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
              </div>
              <div class="ml-5 w-0 flex-1">
                <dt class="text-sm font-medium text-gray-500 truncate">Total Reservations</dt>
                <dd class="text-2xl font-bold text-gray-900"><?= $totalReservations ?></dd>
              </div>
            </div>
          </div>
        </div>

        <!-- Upcoming Stays Card -->
        <div class="luxury-card overflow-hidden shadow-lg rounded-2xl card-hover transition fade-in" style="animation-delay: 0.3s">
          <div class="px-6 py-6">
            <div class="flex items-center">
              <div class="flex-shrink-0 bg-green-100 rounded-xl p-4">
                <i class="fas fa-suitcase-rolling text-green-600 text-xl"></i>
              </div>
              <div class="ml-5 w-0 flex-1">
                <dt class="text-sm font-medium text-gray-500 truncate">Upcoming Stays</dt>
                <dd class="text-2xl font-bold text-gray-900"><?= count($upcomingReservations) ?></dd>
              </div>
            </div>
          </div>
        </div>

        <!-- Manage Upcoming Stays Card -->
        <a href="upcoming.php" class="luxury-card p-6 rounded-2xl shadow-lg card-hover transition fade-in flex items-center" style="animation-delay: 0.4s">
          <div class="bg-blue-100 p-3 rounded-xl">
            <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
          </div>
          <div class="ml-4">
            <h3 class="font-semibold text-gray-900">Manage Upcoming Stays</h3>
            <p class="text-gray-600 text-sm">Edit or cancel reservations</p>
          </div>
        </a>

        <!-- Explore Rooms Card -->
        <a href="book.php" class="luxury-card p-6 rounded-2xl shadow-lg card-hover transition fade-in flex items-center" style="animation-delay: 0.5s">
          <div class="bg-green-100 p-3 rounded-xl">
            <i class="fas fa-bed text-green-600 text-xl"></i>
          </div>
          <div class="ml-4">
            <h3 class="font-semibold text-gray-900">Explore Rooms</h3>
            <p class="text-gray-600 text-sm">Discover luxury accommodations</p>
          </div>
        </a>
      </div>

      <!-- Next Reservation Preview -->
      <div class="luxury-card rounded-2xl shadow-lg p-6 fade-in" style="animation-delay: 0.7s">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Your Next Luxury Experience</h2>
        <?php if ($nextReservation): ?>
          <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div class="flex items-center mb-4 lg:mb-0">
              <div class="room-image w-20 h-20 rounded-xl mr-4 overflow-hidden">
                <img src="../../rooms/<?= htmlspecialchars($nextReservation['image']) ?>" alt="Room Image" class="object-cover w-full h-full">
              </div>
              <div>
                <h3 class="text-lg font-semibold text-gray-900">
                  <?= htmlspecialchars($nextReservation['type']) ?> #<?= htmlspecialchars($nextReservation['numero']) ?>
                </h3>
                <p class="text-gray-600"><?= htmlspecialchars($nextReservation['superficie']) ?> m², premium amenities</p>
              </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center lg:text-right">
              <div>
                <p class="text-sm text-gray-500">Check-in</p>
                <p class="font-semibold"><?= date('F j, Y', strtotime($nextReservation['date_debut'])) ?></p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Check-out</p>
                <p class="font-semibold"><?= date('F j, Y', strtotime($nextReservation['date_fin'])) ?></p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Total</p>
                <p class="font-bold text-blue-600"><?= number_format($nextReservation['total_price'], 2) ?> DH</p>
              </div>
            </div>
          </div>
        <?php else: ?>
          <p class="text-gray-600">You currently have no upcoming reservations.</p>
        <?php endif; ?>
      </div>

    </div>
  </main>

<!-- Simple Footer -->
<footer class="bg-white text-gray-800 mt-8" style="margin-bottom:0;padding-bottom:0;">
  <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0">
      <!-- Hotel Name & Copyright -->
      <div class="flex flex-col items-center md:items-start">
        <p class="text-lg font-bold text-blue-700 mb-1">
          <i class="fas fa-hotel mr-2"></i>Luxury Palace
        </p>
        <p class="text-sm text-blue-600">&copy; <?= date('Y') ?> Luxury Palace. All rights reserved.</p>
      </div>

      <!-- Footer Navigation -->
      <div class="flex flex-col items-center">
        <nav class="mb-2">
          <ul class="flex space-x-6 text-sm">
            <li><a href="dashboard.php" class="hover:text-blue-600 transition">Dashboard</a></li>
            <li><a href="book.php" class="hover:text-blue-600 transition">Book a Room</a></li>
            <li><a href="upcoming.php" class="hover:text-blue-600 transition">My Stays</a></li>
          </ul>
        </nav>
      </div>

      <!-- Contact & Address -->
      <div class="flex flex-col items-center md:items-end">
        <p class="text-sm text-blue-700 mb-1">
          <i class="fas fa-envelope mr-1"></i> info@luxurypalace.ma
        </p>
        <p class="text-sm text-blue-700 mb-1">
          <i class="fas fa-phone-alt mr-1"></i> +212 600-123456
        </p>
        <p class="text-sm text-blue-700">
          <i class="fas fa-map-marker-alt mr-1"></i> 123 Avenue Royale, Casablanca, Morocco
        </p>
      </div>
    </div>
    <div class="border-t border-blue-200 mt-6 pt-4 text-center text-xs text-blue-600">
      Designed &amp; developed by Ziyad Tber
    </div>
  </div>
</footer>
<style>
  html, body {
    height: 100%;
  }
  body {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }
  #dashboard {
    flex: 1 0 auto;
  }
  footer {
    flex-shrink: 0;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
  }
</style>


</div>
</body>
</html>