document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('statusModal');
  const cancelBtn = document.getElementById('cancelModal');
  const statusOptions = document.querySelectorAll('.status-option');
  const selectedStatusInput = document.getElementById('selectedStatus');
  const taskIdInput = document.getElementById('modalTaskId');
  

  document.querySelectorAll('.up').forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const taskId = this.getAttribute('href').split('=')[1];
      taskIdInput.value = taskId;
      modal.classList.remove('hidden');
    });
  });
  
 
  cancelBtn.addEventListener('click', function() {
    modal.classList.add('hidden');
  });
  

  statusOptions.forEach(option => {
    option.addEventListener('click', function() {
   
      statusOptions.forEach(opt => {
        opt.classList.remove('border-indigo-500', 'bg-indigo-50');
      });
      
  
      this.classList.add('border-indigo-500', 'bg-indigo-50');
      
    
      selectedStatusInput.value = this.getAttribute('data-status');
    });
  });
  
 
  window.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.classList.add('hidden');
    }
  });
});