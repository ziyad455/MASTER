        // Sample data - In real application, this would come from your database


        // Initialize the admin panel
        document.addEventListener('DOMContentLoaded', function() {
            initializeAdmin();
            updateClock();
            setInterval(updateClock, 1000);
        });

        function initializeAdmin() {
            setupSidebarNavigation();
            setupFileUpload();
            // populateRoomsTable();
            populateBookingsTable();
            setupForms();
            setupMobileMenu();
        }


        // ... (previous code continues)

        function setupSidebarNavigation() {
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            
            sidebarItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Remove active class from all items
                    sidebarItems.forEach(i => i.classList.remove('active'));
                    
                    // Add active class to clicked item
                    this.classList.add('active');
                    
                    // Hide all sections
                    document.querySelectorAll('.page-section').forEach(section => {
                        section.classList.remove('active');
                    });
                    
                    // Show selected section
                    const pageId = this.getAttribute('data-page');
                    document.getElementById(pageId).classList.add('active');
                    
                    // Update page title
                    document.getElementById('page-title').textContent = this.textContent.trim();
                    
                    // Close mobile menu if open
                    document.querySelector('.sidebar').classList.remove('mobile-open');
                });
            });
        }

        function setupFileUpload() {
            const fileUploadArea = document.getElementById('file-upload-area');
            const fileInput = document.getElementById('room-photo');
            const previewImg = document.getElementById('preview-img');
            const fileName = document.getElementById('file-name');
            const imagePreview = document.getElementById('image-preview');

            // Handle drag and drop
            fileUploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                fileUploadArea.classList.add('dragover');
            });

            fileUploadArea.addEventListener('dragleave', () => {
                fileUploadArea.classList.remove('dragover');
            });

            fileUploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                fileUploadArea.classList.remove('dragover');
                
                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    handleFileUpload(fileInput.files[0]);
                }
            });

            // Handle file selection
            fileInput.addEventListener('change', () => {
                if (fileInput.files.length) {
                    handleFileUpload(fileInput.files[0]);
                }
            });

            function handleFileUpload(file) {
                if (file.type.match('image.*')) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        fileName.textContent = file.name;
                        imagePreview.classList.remove('hidden');
                    };
                    
                    reader.readAsDataURL(file);
                } else {
                    showNotification('Please select an image file', 'error');
                }
            }
        }

        

        function populateBookingsTable() {
            const tbody = document.getElementById('bookings-table-body');
            tbody.innerHTML = '';
            
            bookings.forEach(booking => {
                let statusClass = '';
                let statusText = '';
                
                switch(booking.status) {
                    case 'confirmed':
                        statusClass = 'status-confirmed';
                        statusText = 'Confirmed';
                        break;
                    case 'pending':
                        statusClass = 'status-pending';
                        statusText = 'Pending';
                        break;
                    case 'cancelled':
                        statusClass = 'status-cancelled';
                        statusText = 'Cancelled';
                        break;
                }
                
                const tr = document.createElement('tr');
                tr.className = 'border-b border-gray-200 hover:bg-gray-50';
                tr.innerHTML = `
                    <td class="py-4 px-4">${booking.id}</td>
                    <td class="py-4 px-4">${booking.guestName}</td>
                    <td class="py-4 px-4">${booking.guestId}</td>
                    <td class="py-4 px-4">${booking.roomNumber}</td>
                    <td class="py-4 px-4">${formatDate(booking.checkIn)}</td>
                    <td class="py-4 px-4">${formatDate(booking.checkOut)}</td>
                    <td class="py-4 px-4">
                        <span class="status-badge ${statusClass}">${statusText}</span>
                    </td>
                    <td class="py-4 px-4">
                        <button class="btn-edit mr-2" onclick="editBooking('${booking.id}')">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </button>
                        <button class="btn-danger" onclick="deleteBooking('${booking.id}')">
                            <i class="fas fa-trash mr-1"></i>Delete
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        function setupForms() {
            // Add room form

            
            // Edit room form
            document.getElementById('edit-room-form').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const roomId = parseInt(document.getElementById('edit-room-id').value);
                const roomIndex = rooms.findIndex(r => r.id === roomId);
                
                if (roomIndex !== -1) {
                    rooms[roomIndex] = {
                        ...rooms[roomIndex],
                        number: document.getElementById('edit-room-number').value,
                        name: document.getElementById('edit-room-name').value,
                        type: document.getElementById('edit-room-type').value,
                        size: document.getElementById('edit-room-size').value,
                        price: parseFloat(document.getElementById('edit-room-price').value),
                        rating: parseFloat(document.getElementById('edit-room-rating').value),
                        description: document.getElementById('edit-room-description').value
                    };
                    
                    // populateRoomsTable();
                    closeEditModal();
                    showNotification('Room updated successfully!', 'success');
                }
            });
        }

        function setupMobileMenu() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const sidebar = document.querySelector('.sidebar');
            
            mobileMenuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('mobile-open');
            });
        }

        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
            document.getElementById('current-time').textContent = timeString;
        }

        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('en-US', options);
        }

        function showPage(pageId) {
            document.querySelectorAll('.page-section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(pageId).classList.add('active');
            
            // Update active sidebar item
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('data-page') === pageId) {
                    item.classList.add('active');
                }
            });
            
            document.getElementById('page-title').textContent = 
                document.querySelector(`.sidebar-item[data-page="${pageId}"]`).textContent.trim();
        }

        function showAddRoom() {
            showPage('add-room');
        }

        function editRoom(roomId) {
            const room = rooms.find(r => r.id === roomId);
            if (room) {
                document.getElementById('edit-room-id').value = room.id;
                document.getElementById('edit-room-number').value = room.number;
                document.getElementById('edit-room-name').value = room.name;
                document.getElementById('edit-room-type').value = room.type;
                document.getElementById('edit-room-size').value = room.size;
                document.getElementById('edit-room-price').value = room.price;
                document.getElementById('edit-room-rating').value = room.rating;
                document.getElementById('edit-room-description').value = room.description;
                
                document.getElementById('edit-modal').classList.remove('hidden');
            }
        }

        function closeEditModal() {
            document.getElementById('edit-modal').classList.add('hidden');
        }

        function deleteRoom(roomId) {
            if (confirm('Are you sure you want to delete this room?')) {
                rooms = rooms.filter(r => r.id !== roomId);
                // populateRoomsTable();
                showNotification('Room deleted successfully!', 'success');
            }
        }

        function editBooking(bookingId) {
            const booking = bookings.find(b => b.id === bookingId);
            if (booking) {
                // In a real app, you would open a modal to edit the booking
                alert(`Editing booking ${bookingId}`);
            }
        }

        function deleteBooking(bookingId) {
            if (confirm('Are you sure you want to delete this booking?')) {
                bookings = bookings.filter(b => b.id !== bookingId);
                populateBookingsTable();
                showNotification('Booking deleted successfully!', 'success');
            }
        }

        function resetForm() {
            document.getElementById('add-room-form').reset();
            document.getElementById('image-preview').classList.add('hidden');
            showPage('rooms');
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.add('show');
            }, 10);
            
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }