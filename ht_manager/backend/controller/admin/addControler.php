<?php

session_start();
require "../../database/conectdb.php";
require "../../../frontend/helper/other/Room.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Input sanitization
        $roomNumber = trim($_POST['room-number']);
        $roomType = trim($_POST['room-type']);
        $roomSize = trim($_POST['room-size']);
        $roomPrice = trim($_POST['room-price']);
        $roomDescription = htmlspecialchars(trim($_POST['room-description']), ENT_QUOTES, 'UTF-8');

        // Check if file is uploaded
        if (!isset($_FILES["room-photo"]) || $_FILES["room-photo"]["error"] !== UPLOAD_ERR_OK) {
            throw new Exception("No file was uploaded or there was an upload error.");
        }

        // Allowed extensions
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg');

        // File handling
        $targetDir = __DIR__ . "/../../../rooms/";
        $fileName = basename($_FILES["room-photo"]["name"]);
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validate extension
        if (!in_array($fileType, $allowed_extensions)) {
            throw new Exception("Invalid file type. Only images are allowed.");
        }

        // Generate a unique file name to avoid conflicts
        $newFileName = uniqid() . '_' . $fileName;
        $targetFilePath = $targetDir . $newFileName;

        // Move the uploaded file
        if (!move_uploaded_file($_FILES["room-photo"]["tmp_name"], $targetFilePath)) {
            throw new Exception("Failed to move the uploaded file.");
        }

        // Create Room object
        $roomModel = new Room($roomNumber, $roomType, $roomSize, $roomPrice, $roomDescription, $newFileName);

        // Save to DB
        $result = $roomModel->save($db);

        if (!$result) {
            // If database save fails, delete uploaded image
            if (file_exists($targetFilePath)) {
                unlink($targetFilePath);
            }
            throw new Exception("Failed to save room data to the database.");
        }

        // Save room in session for confirmation (optional)
        $_SESSION['room'] = $roomModel->toArray();

        // Redirect on success
        header("Location: ../../../frontend/admin/main.php");
        exit();

    } catch (Exception $e) {
        // Store error in session for feedback
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: ../../../frontend/admin/addRoom.php");
        exit();
    }

} else {
    // If not POST, redirect to the form page
    header("Location: ../../../frontend/admin/addRoom.php");
    exit();
}
