    // Star rating interaction
    document.querySelectorAll('.star-rating input').forEach(radio => {
      radio.addEventListener('change', function() {
        const form = this.closest('form');
        const rating = this.value;
        console.log(`Rating submitted: ${rating} stars`);
        
        // Show success message
        const existingMessage = form.parentNode.querySelector('.rating-success');
        if (existingMessage) {
          existingMessage.remove();
        }
        
        const successMessage = document.createElement('div');
        successMessage.className = 'rating-success bg-green-50 border border-green-200 rounded-lg p-3 mt-3';
        successMessage.innerHTML = `
          <p class="text-green-800 text-sm">
            <i class="fas fa-check text-green-500 mr-2"></i>
            Thank you for rating your stay! Your feedback helps us improve.
          </p>
        `;
        form.parentNode.insertBefore(successMessage, form.nextSibling);
        
        // Update the display rating
        const ratingDisplay = form.closest('.luxury-card').querySelector('.flex.items-center.mt-2');
        if (ratingDisplay) {
          const stars = ratingDisplay.querySelectorAll('i');
          stars.forEach((star, index) => {
            if (index < rating) {
              star.className = 'fas fa-star text-yellow-400';
            } else {
              star.className = 'far fa-star text-yellow-400';
            }
          });
          const ratingText = ratingDisplay.querySelector('span');
          if (ratingText) {
            ratingText.textContent = `(Your rating: ${rating}/5)`;
          }
        }
      });
    });

