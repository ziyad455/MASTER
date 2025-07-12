<?php
require "../../database/conectdb.php";

if (isset($_POST['id'])) {
    $roomId = intval($_POST['id']);
    echo json_encode(['id' => $roomId]);
    exit;

    $sql = "DELETE FROM chambres WHERE id = ?";
    
    $success = $stmt = $db->delete($sql,[$roomId]);

    if ($success) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No ID provided']);
}
