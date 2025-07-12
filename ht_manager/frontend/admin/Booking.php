<?php
require_once '../../backend/database/conectdb.php';
$bookings = $db->selectALL("
  SELECT 
    r.id,
    u.nom AS guest_name,
    u.email AS guest_email,
    c.numero AS room_number,
    r.date_debut AS check_in,
    r.date_fin AS check_out,
    r.statut AS status
  FROM reservations r
  JOIN users u ON r.id_user = u.id
  JOIN chambres c ON r.id_chambre = c.id
  ORDER BY r.date_debut DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking Management</title>
  <link rel="stylesheet" href="../helper/css/boking.css">

</head>
<body>
  <section id="bookings" class="page-section">
    <div class="admin-card">
      <h3 class="text-xl font-bold text-gray-900 mb-6">Booking Status</h3>
      
      <!-- Filter Buttons -->
      <div class="filter-container">
        <button class="filter-btn active" data-status="all">All</button>
        <button class="filter-btn" data-status="En attente">Pending</button>
        <button class="filter-btn" data-status="Confirmée">Confirmed</button>
        <button class="filter-btn" data-status="Annulée">Cancelled</button>
      </div>
      
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr>
              <th>Booking ID</th>
              <th>Guest Name</th>
              <th>Guest Email</th>
              <th>Room</th>
              <th>Check-in</th>
              <th>Check-out</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="bookings-table-body">
            <tr>
              <td colspan="8" class="loading">Loading bookings...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <script>
    // Get bookings data from PHP
    const sampleBookings = <?= json_encode($bookings, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;

    let allBookings = [];
    let currentFilter = 'all';

    // Initialize the page
    document.addEventListener('DOMContentLoaded', function() {
      loadBookings();
      setupEventListeners();
    });

    function setupEventListeners() {
      // Filter buttons
      document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          // Update active filter styling
          document.querySelectorAll('.filter-btn').forEach(b => {
            b.className = 'filter-btn px-4 py-2 rounded-lg font-medium transition-all duration-200 bg-white text-gray-600 border-2 border-gray-200 hover:border-blue-500 hover:text-blue-500';
          });
          this.className = 'filter-btn px-4 py-2 rounded-lg font-medium transition-all duration-200 bg-blue-500 text-white border-2 border-blue-500';
          
          currentFilter = this.getAttribute('data-status');
          filterBookings();
        });
      });
    }

    // Load bookings data
    function loadBookings() {
      // Simulate API call - replace with actual fetch
      setTimeout(() => {
        allBookings = sampleBookings;
        renderBookings(allBookings);
      }, 500);
    }

    function filterBookings() {
      let filteredBookings;
      
      if (currentFilter === 'all') {
        filteredBookings = allBookings;
      } else {
        filteredBookings = allBookings.filter(booking => booking.status === currentFilter);
      }
      
      renderBookings(filteredBookings);
    }

    function renderBookings(bookings) {
      const tbody = document.getElementById('bookings-table-body');
      
      if (bookings.length === 0) {
        tbody.innerHTML = '<tr><td colspan="8" class="no-data">No bookings found</td></tr>';
        return;
      }

      tbody.innerHTML = bookings.map(booking => {
        const statusClass = getStatusClass(booking.status);
        const actions = getActionsForBooking(booking);
        
        return `
          <tr data-booking-id="${booking.id}">
            <td>#${booking.id}</td>
            <td>${booking.guest_name}</td>
            <td>${booking.guest_email}</td>
            <td>Room ${booking.room_number}</td>
            <td>${formatDate(booking.check_in)}</td>
            <td>${formatDate(booking.check_out)}</td>
            <td>
              <span class="status-badge ${statusClass}">
                ${getStatusText(booking.status)}
              </span>
            </td>
            <td>${actions}</td>
          </tr>
        `;
      }).join('');

      // Add event listeners for action buttons
      addActionListeners();
    }

    function getStatusClass(status) {
      switch(status) {
        case 'En attente': return 'status-pending';
        case 'Confirmée': return 'status-confirmed';
        case 'Annulée': return 'status-cancelled';
        default: return 'status-pending';
      }
    }

    function getStatusText(status) {
      switch(status) {
        case 'En attente': return 'Pending';
        case 'Confirmée': return 'Confirmed';
        case 'Annulée': return 'Cancelled';
        default: return status;
      }
    }

    function getActionsForBooking(booking) {
      if (booking.status === 'En attente') {
        return `
          <div class="actions-container">
            <button class="action-btn btn-confirm" data-action="confirm" data-id="${booking.id}">
              Confirm
            </button>
            <button class="action-btn btn-cancel" data-action="cancel" data-id="${booking.id}">
              Cancel
            </button>
          </div>
        `;
      } else {
        return '<span class="no-actions">No actions</span>';
      }
    }

    function addActionListeners() {
      document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          const action = this.getAttribute('data-action');
          const bookingId = this.getAttribute('data-id');
          
          if (confirm(`Are you sure you want to ${action} this booking?`)) {
            updateBookingStatus(bookingId, action);
          }
        });
      });
    }

    function updateBookingStatus(bookingId, action) {
      const newStatus = action === 'confirm' ? 'Confirmée' : 'Annulée';
      
      // Update in memory (for demo)
      const booking = allBookings.find(b => b.id == bookingId);
      if (booking) {
        booking.status = newStatus;
        filterBookings(); // Re-render with current filter
      }

      fetch('updateBoking.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          booking_id: bookingId,
          status: newStatus
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Reload bookings
          loadBookings();
          alert(`Booking #${bookingId} has been ${action}ed successfully!`);
        } else {
          alert('Error updating booking status');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Error updating booking status');
      });
    }

    function formatDate(dateString) {
      const options = { year: 'numeric', month: 'short', day: 'numeric' };
      return new Date(dateString).toLocaleDateString('en-US', options);
    }
  </script>
</body>
</html>