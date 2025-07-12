  
<?php
  session_start();
 require "../../backend/database/conectdb.php"; 
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
          AND reservations.date_debut > NOW() 
          AND reservations.statut = 'En attente'
        ORDER BY reservations.date_debut ASC";

$upcoming_stays = $db->selectAll($sql, [$_SESSION['user']['id']]);


 
 ?>
 
 <?php require "nav.php" ?>

 
<div id="upcoming-stays" class="page">
  <main class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
      <div class="mb-8 slide-in">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Your Upcoming Stays</h1>
        <p class="text-gray-600">Manage your reservations and prepare for your luxury experiences</p>
      </div>

      <?php if (empty($upcoming_stays)): ?>
        <!-- No Bookings Message -->
        <div class="text-center py-20 fade-in">
          <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
          <h2 class="text-xl font-semibold text-gray-700 mb-2">You haven’t booked anything yet.</h2>
          <p class="text-gray-500 mb-6">Start exploring our luxury rooms and plan your next getaway.</p>
          <button class="bg-blue-600 text-white py-3 px-6 rounded-xl font-semibold hover:bg-blue-700 transition">
            <i class="fas fa-search mr-2"></i> Browse Rooms
          </button>
        </div>

      <?php else: ?>
        <!-- Loop Through Upcoming Reservations -->
        <?php foreach ($upcoming_stays as $stay): ?>
          <div class="rounded-2xl shadow-lg bg-white mb-8 overflow-hidden flex flex-col md:flex-row fade-in">
            <!-- Room Image -->
            <div class="md:w-1/3 w-full h-64 md:h-auto">
              <img src="../../rooms/<?= htmlspecialchars($stay['image']) ?>" alt="Room image" class="object-cover w-full h-full">
            </div>
            <!-- Details -->
            <div class="md:w-2/3 w-full flex flex-col justify-between p-6">
              <!-- Header -->
              <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                <div>
                  <h3 class="text-2xl font-bold text-gray-900 mb-1">
                    <?= htmlspecialchars($stay['type']) ?> Room #<?= htmlspecialchars($stay['numero']) ?>
                  </h3>
                  <p class="text-gray-500"><?= htmlspecialchars($stay['description']) ?></p>
                </div>
              </div>
              <!-- Reservation Info -->
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                  <div class="flex items-center mb-2">
                    <i class="fas fa-calendar text-blue-600 w-5"></i>
                    <span class="ml-2 text-gray-700">
                      <?= date('F j', strtotime($stay['date_debut'])) ?> - <?= date('F j, Y', strtotime($stay['date_fin'])) ?>
                    </span>
                  </div>
                  <div class="flex items-center mb-2">
                    <i class="fas fa-bed text-blue-600 w-5"></i>
                    <span class="ml-2 text-gray-700"><?= ucfirst($stay['type']) ?>, <?= ucfirst($stay['superficie']) ?></span>
                  </div>
                  <div class="flex items-center mb-2">
                    <i class="fas fa-dollar-sign text-blue-600 w-5"></i>
                    <span class="ml-2 text-gray-700 font-semibold"><?= number_format($stay['total_price'], 2) ?> DH Total</span>
                  </div>
                  <div class="flex items-center">
                    <i class="fas fa-info-circle text-blue-600 w-5"></i>
                    <span class="ml-2 text-gray-700">Status: <?= htmlspecialchars($stay['statut']) ?></span>
                  </div>
                </div>
              </div>
              <!-- Actions -->
              <div class="flex justify-end">
                <button type="button" class="cancel-btn bg-red-100 text-red-700 py-2 px-5 rounded-xl font-semibold hover:bg-red-200 transition" data-reservation-id="<?= $stay['id'] ?>">
                  <i class="fas fa-times mr-2"></i>Cancel Booking
                </button>
              </div>
            </div>
          </div>
        <?php endforeach; ?> 
      <?php endif; ?>

    </div>
  </main>
  <script>
  document.querySelectorAll('.cancel-btn').forEach(button => {
    button.addEventListener('click', function () {
      const reservationId = this.getAttribute('data-reservation-id');

      if (!confirm('Are you sure you want to cancel this booking?')) return;

      fetch('../../backend/controller/user/cansel_res.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'reservation_id=' + reservationId
      })
      .then(response => response.text())
      .then(data => {
        console.log('Response:', data);
        parent = button.parentElement.parentElement.parentElement;
        parent.classList.add('hidden');

      })
      .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while canceling the booking.');
      });
    });
  });
</script>

</div>
