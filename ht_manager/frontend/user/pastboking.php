  <?php 
  session_start();
  require "../../backend/database/conectdb.php"; 
  require "nav.php" ?>
<?php
// Fetch past reservations with room info
$sql = "SELECT 
          reservations.*, 
          chambres.numero, 
          chambres.type, 
          chambres.superficie, 
          chambres.prix, 
          chambres.image,
          chambres.description
        FROM reservations
        JOIN chambres ON reservations.id_chambre = chambres.id
        WHERE reservations.id_user = ? 
          AND reservations.date_fin < NOW() 
        ORDER BY reservations.date_debut DESC";

$past_stays = $db->selectAll($sql, [$_SESSION['user']['id']]);
?>

<!-- Past Bookings Page -->
<div id="past-bookings" class="page">
  <main class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
      <div class="mb-8 slide-in">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Your Past Experiences</h1>
        <p class="text-gray-600">Rate your stays and share your luxury experiences</p>
      </div>

      <?php if (empty($past_stays)): ?>
        <!-- No Past Bookings -->
        <div class="luxury-card rounded-2xl shadow-lg p-8 text-center fade-in">
          <div class="mb-4">
            <i class="fas fa-history text-4xl text-blue-600"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-2">No Past Stays Found</h3>
          <p class="text-gray-600 mb-6">You haven't completed any stays yet.</p>
          <a href="book.php" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-8 rounded-xl font-semibold hover:shadow-lg transition transform hover:scale-105 inline-block">
            <i class="fas fa-search mr-2"></i>Explore Rooms
          </a>
        </div>
      <?php else: ?>
        <?php foreach ($past_stays as $stay): ?>
          <!-- Past Reservation Card -->
          <div class="luxury-card rounded-2xl shadow-lg overflow-hidden mb-6 fade-in">
            <div class="p-6">
              <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-4">
                <div class="flex items-center mb-4 lg:mb-0">
                  <?php if (!empty($stay['image'])): ?>
                    <img src="../../rooms/<?= htmlspecialchars($stay['image']) ?>" alt="Room Image" class="w-16 h-16 rounded-xl mr-4 object-cover">
                  <?php else: ?>
                    <div class="room-image w-16 h-16 rounded-xl mr-4 flex items-center justify-center bg-gradient-to-br from-blue-500 to-purple-500 text-white">
                      <i class="fas fa-bed text-2xl"></i>
                    </div>
                  <?php endif; ?>

                  <div>
                    <h3 class="text-xl font-bold text-gray-900"><?= htmlspecialchars($stay['type']) ?> Room #<?= htmlspecialchars($stay['numero']) ?></h3>
                    <p class="text-gray-600"><?= date("F j", strtotime($stay['date_debut'])) ?> - <?= date("j, Y", strtotime($stay['date_fin'])) ?></p>
                    <p class="text-sm text-gray-500 mt-1"><?= htmlspecialchars($stay['superficie']) ?> | <?= htmlspecialchars($stay['description']) ?></p>
                  </div>
                </div>

                <div class="text-right">
                  <p class="text-sm text-gray-500">Total Paid</p>
                  <p class="text-xl font-bold text-gray-900"><?= number_format($stay['total_price'], 2) ?> DH</p>
                  <p class="text-sm text-gray-500 mt-1">Status: <?= htmlspecialchars($stay['statut']) ?></p>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </main>
</div>
