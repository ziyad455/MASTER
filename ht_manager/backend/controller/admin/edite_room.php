<?php
require "../../database/conectdb.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// echo "<pre>";
// var_dump($_FILES['room-photo']);
// var_dump($_POST);
// echo "</pre>";
// die();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roomId = $_POST['room-id'] ?? null;
    $numero = $_POST['room-number'] ?? '';
    $type = $_POST['room-type'] ?? '';
    $superficie = $_POST['room-size'] ?? '';
    $prix = $_POST['room-price'] ?? 0;
    $description = $_POST['room-description'] ?? '';
    $status = $_POST['room-status'] ?? 'availble';


    try {
        if (empty($roomId) || empty($numero) || empty($type) || empty($superficie) || empty($prix)) {
            throw new Exception('All required fields must be filled');
        }

        if (!is_numeric($roomId)) {
            throw new Exception('Invalid room ID');
        }

        $currentRoom = $db->selectOne("SELECT image FROM chambres WHERE id = ?", [$roomId]);
        if (!$currentRoom) {
            throw new Exception('Room not found');
        }
        
        $currentImage = $currentRoom['image'];
        $newFileName = $currentImage; // Keep current image by default
        $imageUpdated = false;

        // Handle file upload if provided
        if (isset($_FILES['room-photo']) && $_FILES['room-photo']['error'] === UPLOAD_ERR_OK) {
            $uploadedFile = $_FILES['room-photo'];
            
            // Validate file type
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($uploadedFile['type'], $allowedTypes)) {
                throw new Exception('Invalid file type. Only JPEG, PNG, GIF, and WebP images are allowed.');
            }
            
            // Validate file size (5MB max)
            if ($uploadedFile['size'] > 5 * 1024 * 1024) {
                throw new Exception('File size must be less than 5MB.');
            }
            
            // Create upload directory if it doesn't exist
            $uploadDir = '../../../rooms/';
            if (!is_dir($uploadDir)) {
                if (!mkdir($uploadDir, 0755, true)) {
                    throw new Exception('Failed to create upload directory');
                }
            }
            
            // Check if directory is writable
            if (!is_writable($uploadDir)) {
                throw new Exception('Upload directory is not writable');
            }
            
            // Generate new filename to avoid conflicts
            $fileExtension = strtolower(pathinfo($uploadedFile['name'], PATHINFO_EXTENSION));
            $newFileName = 'room_' . $roomId . '_' . time() . '.' . $fileExtension;
            $targetPath = $uploadDir . $newFileName;
            
            // Move uploaded file
            if (!move_uploaded_file($uploadedFile['tmp_name'], $targetPath)) {
                throw new Exception('Failed to upload room image');
            }
            
            // Delete old image if it exists and is different from new one
            if ($currentImage && $currentImage !== $newFileName && file_exists($uploadDir . $currentImage)) {
                unlink($uploadDir . $currentImage);
            }
            
            $imageUpdated = true;
            
        } elseif (isset($_FILES['room-photo']) && $_FILES['room-photo']['error'] !== UPLOAD_ERR_NO_FILE) {
            // Handle upload errors
            $uploadErrors = [
                UPLOAD_ERR_INI_SIZE => 'File is too large (exceeds php.ini limit)',
                UPLOAD_ERR_FORM_SIZE => 'File is too large (exceeds form limit)',
                UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
                UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
                UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
                UPLOAD_ERR_EXTENSION => 'File upload stopped by extension'
            ];
            
            $errorCode = $_FILES['room-photo']['error'];
            $errorMessage = $uploadErrors[$errorCode] ?? 'Unknown upload error';
            throw new Exception('Upload error: ' . $errorMessage);
        }

        // Build the update query
        $query = "UPDATE chambres SET 
                 numero = ?, 
                 type = ?, 
                 superficie = ?, 
                 prix = ?, 
                 description = ?, 
                 status = ?";
        $params = [$numero, $type, $superficie, floatval($prix), $description, $status];

        // Add image to query if it was updated
        if ($imageUpdated) {
            $query .= ", image = ?";
            $params[] = $newFileName;
        }

        $query .= " WHERE id = ?";
        $params[] = intval($roomId);

        // Execute update
        $success = $db->update($query, $params);

        if ($success) {
            // Redirect with success message
            header("Location: ../../../frontend/admin/main.php?success=1");
            exit;
        } else {
            throw new Exception('Failed to update room in database');
        }
        
    } catch (Exception $e) {
        // Log error for debugging (optional)
        error_log("Room update error: " . $e->getMessage());
        
        // Redirect back with error message
        header("Location: ../../../frontend/admin/main.php?room-id=" . urlencode($roomId) . "&error=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    // Invalid request method
    header("Location: rooms.php");
    exit;
}