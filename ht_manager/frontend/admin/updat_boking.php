<?php

require '../../database/conectdb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_id'])) {
  try {
    $reservationId = intval($_POST['reservation_id']);
    $success = $db->update(
      "UPDATE reservations SET statut = 'Annulée' WHERE id = ? AND id_user = ?",
      [$reservationId, $_SESSION['user']['id']]
    );
    $room_id = $db->selectOne(
        "SELECT id_chambre FROM reservations WHERE id = ?",
        [$reservationId]  
            )['id_chambre'];
      $db->update(
            'UPDATE chambres SET status = ? WHERE id = ?',
            ['available', $room_id]
        );

    echo $success ? "Booking canceled successfully." : "Failed to cancel booking.";
  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>
