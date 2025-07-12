<?php 
session_start();
require '../../database/conectdb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $checkin = trim($_POST['checkin_date'] ?? '');
    $checkout = trim($_POST['checkout_date'] ?? '');
    $room_id = $_POST['room_id'];
    $prix = floatval($_POST['prix'] ?? 0);


    try {
        $date1 = new DateTime($checkin);
        $date2 = new DateTime($checkout);
        $interval = $date1->diff($date2);
        $nights = (int)$interval->days;
        $total_price = $nights * $prix;


        $db->insert(
            'INSERT INTO reservations (id_user, id_chambre, date_debut, date_fin,statut,total_price) VALUES (?, ?, ?,?, ?, ?)',
            [
                $_SESSION['user']['id'],
                $room_id,
                $date1->format('Y-m-d'),
                $date2->format('Y-m-d'),
                'En attente',
                $total_price
            ]
        );
        $db->update(
            'UPDATE chambres SET status = ? WHERE id = ?',
            ['not available', $room_id]
        );

        header('Location: ../../../../ht_manager/frontend/user/book.php?success=Booking successful');
        exit();
    } catch (Exception $e) {
        // Log the error message for debugging
        error_log("Booking Error: " . $e->getMessage());


        header('Location: ../../../../ht_manager/frontend/user/book.php?error=An error occurred while processing your booking');
        exit();

    }
}
