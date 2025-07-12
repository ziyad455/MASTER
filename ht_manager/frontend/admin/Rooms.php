<?php
require "../../backend/database/conectdb.php";
// require "../../backend/controller/admin/roomHandler.php";
// require "../../backend/controller/admin/roomHandler.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rooms = $db->selectALL("SELECT * FROM chambres");
if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: ../core/guist.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Room Management</title>
  <link rel="stylesheet" href="../helper/css/admin.css">
</head>
<body>
        <!-- Room Management Section -->
        <section id="rooms" class="page-section p-6">
            <div class="admin-card p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Room Management</h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4">Image</th>
                                <th class="text-left py-3 px-4">Room Number</th>
                                <th class="text-left py-3 px-4">Type</th>
                                <th class="text-left py-3 px-4">Size</th>
                                <th class="text-left py-3 p-4">Price</th>
                                <th class="text-left py-3 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="rooms-table-body">
                            <?php foreach ($rooms as $room): ?>
                                <tr class="border-b border-gray-200 hover:bg-gray-50" data-id="<?= $room['id'] ?>">

                                    <td class="py-4 px-4">
                                        <img src="../../rooms/<?= htmlspecialchars($room['image']) ?>" 
                                             class="room-image-preview" 
                                             alt="<?= htmlspecialchars($room['description']) ?>">
                                    </td>
                                    <td class="py-4 px-4"><?= htmlspecialchars($room['numero']) ?></td>
                                    <td class="py-4 px-4 capitalize"><?= htmlspecialchars($room['type']) ?></td>
                                    <td class="py-4 px-4 capitalize"><?= htmlspecialchars($room['superficie']) ?></td>
                                    <td class="py-4 px-4">$<?= number_format($room['prix'], 2) ?></td>
                                   <td class="py-4 px-4">
                                      <a href="edite_room.php?id=<?= $room['id'] ?>" class="btn-edit mr-2">
                                          <i class="fas fa-edit mr-1"></i>Edit
                                      </a>
                                      <a href="../../backend/controller/admin/delete.php?id=<?= $room['id'] ?>" 
                                        class="btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this room?');">
                                          <i class="fas fa-trash mr-1"></i>Delete
                                      </a>
                                  </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <script>
            function deleteRoom(id) {
  if (!confirm("Are you sure you want to delete this room?")) {
    return; 
  }

  fetch('../../backend/controller/admin/roomHandler.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `id=${id}`
  })
  .then(response => response.json())
  .then(data => {
    if (data.status === 'success') {
      const row = document.querySelector(`tr[data-id='${id}']`);
      if (row) row.remove();
      alert("Room deleted successfully!");
    } else {
      alert("Error deleting room: " + (data.message || 'Unknown error'));
    }
  })
  .catch(error => {
    alert("Request failed: " + error);
  });
}

        </script>
</body>
</html>