<?php
// update-booking-status.php
require "../../backend/database/conectdb.php";


header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        
        $input = json_decode(file_get_contents('php://input'), true);
        
        $bookingId = $input['booking_id'] ?? null;
        $status = $input['status'] ?? null;
        
       
        if (!$bookingId || !$status) {
            throw new Exception('Missing required fields');
        }
        
        
        $allowedStatuses = ['En attente', 'Confirmée', 'Annulée'];
        if (!in_array($status, $allowedStatuses)) {
            throw new Exception('Invalid status');
        }
        
        // Validate booking exists
        $booking = $db->selectOne("SELECT id FROM reservations WHERE id = ?", [$bookingId]);
        if (!$booking) {
            throw new Exception('Booking not found');
        }
        
        // Update booking status
        $query = "UPDATE reservations SET statut = ? WHERE id = ?";
        $success = $db->update($query, [$status, $bookingId]);
        
        if ($success) {
            echo json_encode([
                'success' => true,
                'message' => 'Booking status updated successfully'
            ]);
        } else {
            throw new Exception('Failed to update booking status');
        }
        
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'error' => 'Method not allowed'
    ]);
}