<?php
require "../../backend/database/conectdb.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: ../core/guist.php");
    exit();
}

// Get room ID from URL
$roomId = $_GET['id'] ?? null;
if (!$roomId || !is_numeric($roomId)) {
    die("Invalid room ID");
}

// Fetch room data
$room = $db->selectOne("SELECT * FROM chambres WHERE id = ?", [$roomId]);
if (!$room) {
    die("Room not found");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room #<?= $roomId ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
         <link rel="stylesheet" href="../helper/css/edite_room.css">
</head>
<body>
    <div class="container">        
        <div class="form-container">
            <div class="header">
                <h1>
                    <i class="fas fa-edit"></i>
                    Edit Room #<?= htmlspecialchars($room['numero']) ?>
                </h1>
                <p>Update room details and amenities</p>
            </div>
            
            <div class="form-content">
                <?php if (isset($_GET['error'])): ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Error: <?= htmlspecialchars($_GET['error']) ?></span>
                    </div>
                <?php endif; ?>
                
                <form action="../../backend/controller/admin/edite_room.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="room-id" value="<?= $room['id'] ?>">
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="room-number">
                                <i class="fas fa-hashtag"></i> Room Number
                            </label>
                            <div class="input-wrapper">
                                <input type="text" id="room-number" name="room-number" value="<?= htmlspecialchars($room['numero']) ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="room-type">
                                <i class="fas fa-bed"></i> Room Type
                            </label>
                            <select id="room-type" name="room-type" required>
                                <option value="simple" <?= $room['type'] === 'simple' ? 'selected' : '' ?>>Simple Room</option>
                                <option value="double" <?= $room['type'] === 'double' ? 'selected' : '' ?>>Double Room</option>
                                <option value="suite" <?= $room['type'] === 'suite' ? 'selected' : '' ?>>Luxury Suite</option>
                                <option value="familiale" <?= $room['type'] === 'familiale' ? 'selected' : '' ?>>Family Room</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="room-size">
                                <i class="fas fa-expand-arrows-alt"></i> Room Size
                            </label>
                            <select id="room-size" name="room-size" required>
                                <option value="petite" <?= $room['superficie'] === 'petite' ? 'selected' : '' ?>>Petite (20-30 m²)</option>
                                <option value="moyenne" <?= $room['superficie'] === 'moyenne' ? 'selected' : '' ?>>Moyenne (30-45 m²)</option>
                                <option value="grande" <?= $room['superficie'] === 'grande' ? 'selected' : '' ?>>Grande (45+ m²)</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="room-price">
                                <i class="fas fa-dollar-sign"></i> Price per Night (DH)
                            </label>
                            <div class="input-wrapper">
                                <input type="number" id="room-price" name="room-price" step="0.01" value="<?= htmlspecialchars($room['prix']) ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group full-width">
                            <label for="room-description">
                                <i class="fas fa-align-left"></i> Room Description
                            </label>
                            <textarea id="room-description" name="room-description" required placeholder="Describe the room amenities, features, and what makes it special..."><?= htmlspecialchars($room['description']) ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="room-status">
                                <i class="fas fa-toggle-on"></i> Room Status
                            </label>
                            <select id="room-status" name="room-status" required>
                                <option value="available" <?= $room['status'] === 'availble' ? 'selected' : '' ?>>✅ Available</option>
                                <option value="not available" <?= $room['status'] === 'not_availble' ? 'selected' : '' ?>>❌ Not Available</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="image-section">
                        <h3>
                            <i class="fas fa-camera"></i>
                            Room Photography
                        </h3>
                        <div class="image-container">
                            <img id="current-image" src="../../rooms/<?= htmlspecialchars($room['image']) ?>" class="image-preview" alt="Current room image">
                            <img id="new-image-preview" class="image-preview" style="display: none;" alt="New room image preview">
                        </div>
                        
                        <label for="room-photo" class="file-upload">
                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                            <span id="upload-text">Click to change photo</span>
                            <div style="font-size: 12px; margin-top: 4px; opacity: 0.7;">
                                Maximum 5MB • JPG, PNG, WebP
                            </div>
                            <input type="file" id="room-photo" name="room-photo" accept="image/*">
                        </label>
                    </div>
                    
                    <div class="buttons">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Update Room
                        </button>
                        <a href="rooms.php" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('room-photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file type
                if (!file.type.startsWith('image/')) {
                    alert('Please select a valid image file.');
                    e.target.value = '';
                    return;
                }
                
                // Validate file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB.');
                    e.target.value = '';
                    return;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(event) {
                    // Hide current image and show new preview
                    document.getElementById('current-image').style.display = 'none';
                    const newPreview = document.getElementById('new-image-preview');
                    newPreview.src = event.target.result;
                    newPreview.style.display = 'block';
                    
                    // Update the upload text
                    document.getElementById('upload-text').innerHTML = '<i class="fas fa-check"></i> Selected: ' + file.name;
                }
                
                reader.readAsDataURL(file);
            } else {
                // Reset if no file selected
                document.getElementById('current-image').style.display = 'block';
                document.getElementById('new-image-preview').style.display = 'none';
                document.getElementById('upload-text').innerHTML = '<i class="fas fa-cloud-upload-alt"></i> Click to change photo';
            }
        });

        // Add smooth transitions and animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate form elements on focus
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</body>
</html>