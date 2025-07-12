    // Validation functions
    function showError(fieldId, message) {
      const field = document.getElementById(fieldId);
      const errorElement = document.getElementById(fieldId + '-error');
      
      field.classList.add('input-error');
      errorElement.textContent = message;
      errorElement.style.display = 'block';
      
      if (fieldId === 'room-photo') {
        document.getElementById('file-upload-area').classList.add('error');
      }
    }

    function clearError(fieldId) {
      const field = document.getElementById(fieldId);
      const errorElement = document.getElementById(fieldId + '-error');
      
      field.classList.remove('input-error');
      errorElement.style.display = 'none';
      
      if (fieldId === 'room-photo') {
        document.getElementById('file-upload-area').classList.remove('error');
      }
    }

    function clearAllErrors() {
      const fields = ['room-number', 'room-type', 'room-size', 'room-price', 'room-description', 'room-photo'];
      fields.forEach(fieldId => {
        clearError(fieldId);
      });
    }

    function validateRoomNumber() {
      const roomNumber = document.getElementById('room-number').value.trim();
      
      if (!roomNumber) {
        showError('room-number', 'Room number is required');
        return false;
      }
      
      if (roomNumber.length < 2) {
        showError('room-number', 'Room number must be at least 2 characters');
        return false;
      }
      
      clearError('room-number');
      return true;
    }

    function validateRoomType() {
      const roomType = document.getElementById('room-type').value;
      
      if (!roomType) {
        showError('room-type', 'Please select a room type');
        return false;
      }
      
      clearError('room-type');
      return true;
    }

    function validateRoomSize() {
      const roomSize = document.getElementById('room-size').value;
      
      if (!roomSize) {
        showError('room-size', 'Please select a room size');
        return false;
      }
      
      clearError('room-size');
      return true;
    }

    function validateRoomPrice() {
      const roomPrice = document.getElementById('room-price').value;
      
      if (!roomPrice) {
        showError('room-price', 'Price is required');
        return false;
      }
      
      if (isNaN(roomPrice) || parseFloat(roomPrice) <= 0) {
        showError('room-price', 'Please enter a valid price greater than 0');
        return false;
      }
      
      if (parseFloat(roomPrice) > 10000) {
        showError('room-price', 'Price cannot exceed $10,000 per night');
        return false;
      }
      
      clearError('room-price');
      return true;
    }

    function validateRoomDescription() {
      const roomDescription = document.getElementById('room-description').value.trim();
      
      if (!roomDescription) {
        showError('room-description', 'Room description is required');
        return false;
      }
      
      if (roomDescription.length < 10) {
        showError('room-description', 'Description must be at least 10 characters');
        return false;
      }
      
      if (roomDescription.length > 500) {
        showError('room-description', 'Description cannot exceed 500 characters');
        return false;
      }
      
      clearError('room-description');
      return true;
    }

    function validateRoomPhoto() {
      const roomPhoto = document.getElementById('room-photo').files[0];
      
      if (!roomPhoto) {
        showError('room-photo', 'Room photo is required');
        return false;
      }
      
      // Check file type
      const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
      if (!allowedTypes.includes(roomPhoto.type)) {
        showError('room-photo', 'Please select a valid image file (JPEG, PNG, GIF, WebP)');
        return false;
      }
      
      // Check file size (5MB limit)
      if (roomPhoto.size > 5 * 1024 * 1024) {
        showError('room-photo', 'Image size cannot exceed 5MB');
        return false;
      }
      
      clearError('room-photo');
      return true;
    }

    // Real-time validation
    document.getElementById('room-number').addEventListener('blur', validateRoomNumber);
    document.getElementById('room-type').addEventListener('change', validateRoomType);
    document.getElementById('room-size').addEventListener('change', validateRoomSize);
    document.getElementById('room-price').addEventListener('blur', validateRoomPrice);
    document.getElementById('room-description').addEventListener('blur', validateRoomDescription);
    document.getElementById('room-photo').addEventListener('change', function() {
      validateRoomPhoto();
      handleImagePreview();
    });

    // Form submission validation
    document.getElementById('add-room-form').addEventListener('submit', function(e) {
      e.preventDefault();
      
      clearAllErrors();
      
      const validations = [
        validateRoomNumber(),
        validateRoomType(),
        validateRoomSize(),
        validateRoomPrice(),
        validateRoomDescription(),
        validateRoomPhoto()
      ];
      
      const isValid = validations.every(validation => validation === true);
      
      if (isValid) {
        // If all validations pass, submit the form
        this.submit();
      } else {
        // Scroll to first error
        const firstError = document.querySelector('.input-error, .error');
        if (firstError) {
          firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      }
    });

    // Image preview functionality
    function handleImagePreview() {
      const fileInput = document.getElementById('room-photo');
      const preview = document.getElementById('image-preview');
      const previewImg = document.getElementById('preview-img');
      const fileName = document.getElementById('file-name');
      
      if (fileInput.files && fileInput.files[0]) {
        const file = fileInput.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
          previewImg.src = e.target.result;
          fileName.textContent = file.name;
          preview.classList.remove('hidden');
        };
        
        reader.readAsDataURL(file);
      }
    }


    const fileUploadArea = document.getElementById('file-upload-area');
    const fileInput = document.getElementById('room-photo');

    fileUploadArea.addEventListener('click', function() {
      fileInput.click();
    });

    fileUploadArea.addEventListener('dragover', function(e) {
      e.preventDefault();
      this.style.borderColor = '#3b82f6';
    });

    fileUploadArea.addEventListener('dragleave', function(e) {
      e.preventDefault();
      this.style.borderColor = '#d1d5db';
    });

    fileUploadArea.addEventListener('drop', function(e) {
      e.preventDefault();
      this.style.borderColor = '#d1d5db';
      
      const files = e.dataTransfer.files;
      if (files.length > 0) {
        fileInput.files = files;
        validateRoomPhoto();
        handleImagePreview();
      }
    });


    function resetForm() {
      document.getElementById('add-room-form').reset();
      clearAllErrors();
      document.getElementById('image-preview').classList.add('hidden');
    }


    document.getElementById('room-number').addEventListener('input', function() {
      if (this.value.trim()) clearError('room-number');
    });

    document.getElementById('room-price').addEventListener('input', function() {
      if (this.value.trim()) clearError('room-price');
    });

    document.getElementById('room-description').addEventListener('input', function() {
      if (this.value.trim()) clearError('room-description');
    });