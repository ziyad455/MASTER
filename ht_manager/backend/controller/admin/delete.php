<?php
require "../../database/conectdb.php";
// require "../../../frontend/admin/Rooms.php";
if (isset($_GET['id'])) {
    $roomId = intval($_GET['id']); 

    // استعلام الحذف
    $sql = "DELETE FROM chambres WHERE id = ?";

    // نفذ الحذف
    $deleted = $db->delete($sql, [$roomId]);

    if ($deleted) {
        header("Location: ../../../frontend/admin/main.php?msg=deleted");
        exit;
    } else {
        echo "Error: Failed to delete the room.";
    }
} else {
    echo "Error: No room ID provided.";
}
