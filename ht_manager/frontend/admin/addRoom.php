
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: ../core/guist.php");
    exit();
}?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../helper/css/admin.css">
  <style>
    .error-message {
      color: #dc2626;
      font-size: 0.875rem;
      margin-top: 0.25rem;
      display: block;
    }
    
    .input-error {
      border-color: #dc2626 !important;
      box-shadow: 0 0 0 1px #dc2626 !important;
    }
    
    .file-upload-area {
      border: 2px dashed #d1d5db;
      border-radius: 0.5rem;
      padding: 2rem;
      text-align: center;
      cursor: pointer;
      transition: border-color 0.3s;
    }
    
    .file-upload-area:hover {
      border-color: #3b82f6;
    }
    
    .file-upload-area.error {
      border-color: #dc2626;
    }
    
    .room-image-preview {
      max-width: 200px;
      max-height: 150px;
      object-fit: cover;
      border-radius: 0.5rem;
    }
    
    .btn-primary {
      background-color: #3b82f6;
      color: white;
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 0.5rem;
      cursor: pointer;
      font-weight: 500;
    }
    
    .btn-danger {
      background-color: #dc2626;
      color: white;
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 0.5rem;
      cursor: pointer;
      font-weight: 500;
    }
    
    .admin-card {
      background: white;
      border-radius: 0.5rem;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .page-section {
      padding: 1.5rem;
    }
    
    .admin-card {
      max-width: 1200px;
      margin: 0 auto;
    }
  </style>
</head>
<body>
  <section id="add-room" class="page-section p-6">
    <div class="admin-card p-6">
      <h3 class="text-xl font-bold text-gray-900 mb-6">Add New Room</h3>
      
      <form id="add-room-form" action="../../backend/controller/admin/addControler.php" class="space-y-6" enctype="multipart/form-data" method="POST">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Room Number</label>
            <input type="text" id="room-number" name="room-number" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., 101">
            <span id="room-number-error" class="error-message" style="display: none;"></span>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Room Type</label>
            <select id="room-type" name="room-type" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
              <option value="">Select Type</option>
              <option value="simple">Simple</option>
              <option value="double">Double</option>
              <option value="suite">Suite</option>
              <option value="familiale">Familiale</option>
            </select>
            <span id="room-type-error" class="error-message" style="display: none;"></span>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Room Size</label>
            <select id="room-size" name="room-size" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
              <option value="">Select Size</option>
              <option value="petite">Petite</option>
              <option value="moyenne">Moyenne</option>
              <option value="grande">Grande</option>
            </select>
            <span id="room-size-error" class="error-message" style="display: none;"></span>
          </div>
          
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Price per Night ($)</label>
            <input type="number" id="room-price" name="room-price" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="300">
            <span id="room-price-error" class="error-message" style="display: none;"></span>
          </div>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Room Description</label>
          <textarea id="room-description" name="room-description" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Describe the room features and amenities..."></textarea>
          <span id="room-description-error" class="error-message" style="display: none;"></span>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Room Photo</label>
          <div class="file-upload-area" id="file-upload-area">
            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
            <p class="text-lg font-medium text-gray-700 mb-2">Drag & drop room photo here</p>
            <p class="text-sm text-gray-500 mb-4">or click to browse files</p>
            <input type="file" id="room-photo" name="room-photo" accept="image/*" class="hidden">
            <button type="button" class="btn-primary" onclick="document.getElementById('room-photo').click()">
              Choose File
            </button>
          </div>
          <span id="room-photo-error" class="error-message" style="display: none;"></span>
          <div id="image-preview" class="mt-4 hidden">
            <img id="preview-img" class="room-image-preview">
            <p id="file-name" class="text-sm text-gray-600 mt-2"></p>
          </div>
        </div>
        
        <div class="flex gap-4">
          <button type="submit" class="btn-primary">
            <i class="fas fa-save mr-2"></i>Add Room
          </button>
          <button type="button" class="btn-danger" onclick="resetForm()">
            <i class="fas fa-times mr-2"></i>Cancel
          </button>
        </div>
      </form>
    </div>
  </section>

  <script src="../helper/js/admin/addroom.js">
  </script>
</body>
</html>