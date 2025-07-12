// Room Filter System
class RoomFilter {
    constructor() {
        this.rooms = [];
        this.currentFilters = {
            type: 'all',
            superficie: 'all'
        };
        this.init();
    }

    init() {
        this.setupRoomData();
        this.createFilterUI();
        this.bindEvents();
        this.updateRoomCount();
    }

    setupRoomData() {
        // Define room data with types and superficie
        this.rooms = [
            {
                id: 'room-1',
                name: 'Deluxe Ocean View',
                type: 'double',
                superficie: 'moyenne',
                element: null
            },
            {
                id: 'room-2',
                name: 'Executive Suite',
                type: 'suite',
                superficie: 'grande',
                element: null
            },
            {
                id: 'room-3',
                name: 'Presidential Villa',
                type: 'suite',
                superficie: 'grande',
                element: null
            },
            {
                id: 'room-4',
                name: 'Romantic Getaway',
                type: 'double',
                superficie: 'moyenne',
                element: null
            },
            {
                id: 'room-5',
                name: 'Garden Paradise',
                type: 'simple',
                superficie: 'petite',
                element: null
            },
            {
                id: 'room-6',
                name: 'Wellness Retreat',
                type: 'familiale',
                superficie: 'grande',
                element: null
            }
        ];

        // Get room elements and assign them
        const roomCards = document.querySelectorAll('.room-card');
        roomCards.forEach((card, index) => {
            if (this.rooms[index]) {
                this.rooms[index].element = card;
                card.setAttribute('data-room-id', this.rooms[index].id);
                card.setAttribute('data-type', this.rooms[index].type);
                card.setAttribute('data-superficie', this.rooms[index].superficie);
            }
        });
    }

    createFilterUI() {
        const filterHTML = `
            <div class="filter-section p-6 mb-8 shadow-lg">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-filter mr-2"></i>Filter Rooms
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Room Type Filter -->
                    <div class="filter-group">
                        <label class="filter-label">Room Type</label>
                        <div class="filter-options">
                            <button class="filter-btn active" data-filter="type" data-value="all">
                                <i class="fas fa-th mr-1"></i>All Types
                            </button>
                            <button class="filter-btn" data-filter="type" data-value="simple">
                                <i class="fas fa-bed mr-1"></i>Simple
                            </button>
                            <button class="filter-btn" data-filter="type" data-value="double">
                                <i class="fas fa-bed mr-1"></i>Double
                            </button>
                            <button class="filter-btn" data-filter="type" data-value="suite">
                                <i class="fas fa-crown mr-1"></i>Suite
                            </button>
                            <button class="filter-btn" data-filter="type" data-value="familiale">
                                <i class="fas fa-users mr-1"></i>Familiale
                            </button>
                        </div>
                    </div>

                    <!-- Surface Area Filter -->
                    <div class="filter-group">
                        <label class="filter-label">Surface Area</label>
                        <div class="filter-options">
                            <button class="filter-btn active" data-filter="superficie" data-value="all">
                                <i class="fas fa-expand mr-1"></i>All Sizes
                            </button>
                            <button class="filter-btn" data-filter="superficie" data-value="petite">
                                <i class="fas fa-compress mr-1"></i>Petite
                            </button>
                            <button class="filter-btn" data-filter="superficie" data-value="moyenne">
                                <i class="fas fa-expand-arrows-alt mr-1"></i>Moyenne
                            </button>
                            <button class="filter-btn" data-filter="superficie" data-value="grande">
                                <i class="fas fa-expand mr-1"></i>Grande
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-4">
                    <button class="clear-filters-btn">
                        <i class="fas fa-times mr-1"></i>Clear All Filters
                    </button>
                    <div class="room-count" id="room-count">
                        Showing all rooms
                    </div>
                </div>
            </div>
        `;

        // Insert filter UI before the room gallery
        const roomGallery = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-2.lg\\:grid-cols-3');
        if (roomGallery) {
            roomGallery.insertAdjacentHTML('beforebegin', filterHTML);
        }
    }

    bindEvents() {
        // Filter button events
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('filter-btn') || e.target.closest('.filter-btn')) {
                const btn = e.target.classList.contains('filter-btn') ? e.target : e.target.closest('.filter-btn');
                this.handleFilterClick(btn);
            }
        });

        // Clear filters event
        const clearBtn = document.querySelector('.clear-filters-btn');
        if (clearBtn) {
            clearBtn.addEventListener('click', () => this.clearAllFilters());
        }
    }

    handleFilterClick(btn) {
        const filterType = btn.getAttribute('data-filter');
        const filterValue = btn.getAttribute('data-value');

        // Remove active class from siblings
        const siblings = btn.parentElement.querySelectorAll('.filter-btn');
        siblings.forEach(sibling => sibling.classList.remove('active'));

        // Add active class to clicked button
        btn.classList.add('active');

        // Update current filters
        this.currentFilters[filterType] = filterValue;

        // Apply filters
        this.applyFilters();
    }

    applyFilters() {
        let visibleCount = 0;

        this.rooms.forEach(room => {
            if (!room.element) return;

            const typeMatch = this.currentFilters.type === 'all' || room.type === this.currentFilters.type;
            const superficieMatch = this.currentFilters.superficie === 'all' || room.superficie === this.currentFilters.superficie;

            if (typeMatch && superficieMatch) {
                room.element.classList.remove('filter-hidden');
                room.element.classList.remove('filtering');
                visibleCount++;
            } else {
                room.element.classList.add('filtering');
                setTimeout(() => {
                    room.element.classList.add('filter-hidden');
                    room.element.classList.remove('filtering');
                }, 300);
            }
        });

        this.updateRoomCount(visibleCount);
    }

    updateRoomCount(count = null) {
        const roomCountEl = document.getElementById('room-count');
        if (!roomCountEl) return;

        if (count === null) {
            count = this.rooms.filter(room => room.element && !room.element.classList.contains('filter-hidden')).length;
        }

        if (count === this.rooms.length) {
            roomCountEl.innerHTML = '<i class="fas fa-home mr-1"></i>Showing all rooms';
        } else {
            roomCountEl.innerHTML = `<i class="fas fa-home mr-1"></i>Showing ${count} of ${this.rooms.length} rooms`;
        }
    }

    clearAllFilters() {
        // Reset filters
        this.currentFilters = {
            type: 'all',
            superficie: 'all'
        };

        // Reset button states
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('active');
            if (btn.getAttribute('data-value') === 'all') {
                btn.classList.add('active');
            }
        });

        // Show all rooms
        this.rooms.forEach(room => {
            if (room.element) {
                room.element.classList.remove('filter-hidden', 'filtering');
            }
        });

        this.updateRoomCount();
    }
}

// Initialize the filter system when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function() {
        new RoomFilter();
    });
} else {
    new RoomFilter();
}

document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('booking-modal');
  const modalContent = document.getElementById('modal-content');
  const bookNowButtons = document.querySelectorAll('.book-now-btn');
  const cancelButton = document.getElementById('cancel-booking');
  const bookingForm = document.getElementById('booking-form');
  const checkinInput = document.getElementById('checkin-date');
  const checkoutInput = document.getElementById('checkout-date');
  const roomIdInput = document.getElementById('room-id');
  const priceInput = document.getElementById('price-id');

  let currentRoomPrice = 0;

  // Set minimum date to today
  const today = new Date().toISOString().split('T')[0];
  checkinInput.min = today;
  checkoutInput.min = today;

  // Open modal and set room data
  bookNowButtons.forEach(button => {
    button.addEventListener('click', function() {
      const roomId = this.dataset.roomId;
      const roomNumber = this.dataset.roomNumber;
      const roomPrice = this.dataset.roomPrice;
      const roomType = this.dataset.roomType;

      // FIXED: Clear and set values properly
      roomIdInput.value = roomId;
      priceInput.value = roomPrice;
      currentRoomPrice = parseFloat(roomPrice);

      console.log('Room ID set to:', roomIdInput.value); // Debug
      console.log('Price set to:', priceInput.value); // Debug

      document.getElementById('modal-room-info').textContent = `Room Number ${roomNumber} - ${roomType}`;

      // Reset form but keep the room data
      bookingForm.reset();
      roomIdInput.value = roomId; // Set again after reset
      priceInput.value = roomPrice; // Set again after reset

      updatePriceDisplay();

      modal.classList.remove('hidden');
      setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
      }, 10);
    });
  });

  function closeModal() {
    modalContent.classList.add('scale-95', 'opacity-0');
    modalContent.classList.remove('scale-100', 'opacity-100');
    setTimeout(() => {
      modal.classList.add('hidden');
    }, 300);
  }

  cancelButton.addEventListener('click', closeModal);

  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      closeModal();
    }
  });

  function clearErrors() {
    const errorElements = ['checkin-error', 'checkout-error'];
    errorElements.forEach(id => {
      const element = document.getElementById(id);
      if (element) {
        element.classList.add('hidden');
        element.textContent = '';
      }
    });

    const inputs = ['checkin-date', 'checkout-date'];
    inputs.forEach(id => {
      const input = document.getElementById(id);
      if (input) {
        input.classList.remove('border-red-500', 'focus:ring-red-500');
        input.classList.add('border-gray-300', 'focus:ring-blue-500');
      }
    });
  }

  function showError(inputId, message) {
    const errorId = inputId + '-error';
    const errorElement = document.getElementById(errorId);
    const inputElement = document.getElementById(inputId);

    if (errorElement && inputElement) {
      errorElement.textContent = message;
      errorElement.classList.remove('hidden');
      inputElement.classList.remove('border-gray-300', 'focus:ring-blue-500');
      inputElement.classList.add('border-red-500', 'focus:ring-red-500');
    }
  }

  function validateForm() {
    clearErrors();
    let isValid = true;

    const checkinDate = checkinInput.value;
    const checkoutDate = checkoutInput.value;

    if (!checkinDate) {
      showError('checkin-date', 'Check-in date is required');
      isValid = false;
    } else {
      const today = new Date().toISOString().split('T')[0];
      if (checkinDate < today) {
        showError('checkin-date', 'Check-in date cannot be in the past');
        isValid = false;
      }
    }

    if (!checkoutDate) {
      showError('checkout-date', 'Check-out date is required');
      isValid = false;
    } else if (checkinDate && checkoutDate <= checkinDate) {
      showError('checkout-date', 'Check-out date must be after check-in date');
      isValid = false;
    }

    return isValid;
  }

  checkinInput.addEventListener('change', function() {
    const checkinDate = new Date(this.value);
    checkinDate.setDate(checkinDate.getDate() + 1);
    checkoutInput.min = checkinDate.toISOString().split('T')[0];

    if (checkoutInput.value && checkoutInput.value <= this.value) {
      checkoutInput.value = '';
    }
    updatePriceDisplay();
  });

  checkoutInput.addEventListener('change', function() {
    updatePriceDisplay();
  });

  function updatePriceDisplay() {
    const checkinDate = checkinInput.value;
    const checkoutDate = checkoutInput.value;

    if (checkinDate && checkoutDate && checkoutDate > checkinDate) {
      const checkin = new Date(checkinDate);
      const checkout = new Date(checkoutDate);
      const timeDifference = checkout.getTime() - checkin.getTime();
      const nights = Math.ceil(timeDifference / (1000 * 3600 * 24));
      const totalPrice = nights * currentRoomPrice;
      
      document.getElementById('nights-display').textContent = `${nights} night${nights > 1 ? 's' : ''}`;
      document.getElementById('total-price').textContent = `$${totalPrice.toFixed(2)}`;
      document.getElementById('price-breakdown').textContent = `${nights} nights × $${currentRoomPrice}/night`;
    } else {
      document.getElementById('nights-display').textContent = '0 nights';
      document.getElementById('total-price').textContent = '$0';
      document.getElementById('price-breakdown').textContent = `0 nights × $${currentRoomPrice}/night`;
    }
  }

  bookingForm.addEventListener('submit', function(e) {
    e.preventDefault();

    // Debug: Check values before submission
    console.log('Before submit - Room ID:', roomIdInput.value);
    console.log('Before submit - Price:', priceInput.value);

    if (!validateForm()) {
      return;
    }

    // Final check
    if (!roomIdInput.value) {
      alert('Error: Room ID is missing');
      return;
    }

    this.submit();
  });
});

        let autoHideTimer;

        // Function to show the booking modal
        function showBookingModal() {
            const modal = document.getElementById('bookingModal');
            const modalContent = modal.querySelector('.relative');
            
            // Show modal
            modal.classList.remove('invisible', 'opacity-0');
            modal.classList.add('visible', 'opacity-100');
            
            // Animate modal content
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'translate-y-4');
                modalContent.classList.add('scale-100', 'translate-y-0');
            }, 10);

            // Auto-hide after 5 seconds
            clearTimeout(autoHideTimer);
            autoHideTimer = setTimeout(() => {
                hideBookingModal();
            }, 5000);
        }

        // Function to hide the booking modal
        function hideBookingModal() {
            const modal = document.getElementById('bookingModal');
            const modalContent = modal.querySelector('.relative');
            
            // Animate modal content out
            modalContent.classList.remove('scale-100', 'translate-y-0');
            modalContent.classList.add('scale-95', 'translate-y-4');
            
            // Hide modal after animation
            setTimeout(() => {
                modal.classList.remove('visible', 'opacity-100');
                modal.classList.add('invisible', 'opacity-0');
            }, 200);


            clearTimeout(autoHideTimer);
        }


        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideBookingModal();
            }
        });
