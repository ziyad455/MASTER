    document.addEventListener("DOMContentLoaded", function() {
      // Password visibility toggle
      document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
          const targetId = this.getAttribute('data-target');
          const input = document.getElementById(targetId);
          const eyeOpen = this.querySelector('.eye-open');
          const eyeClosed = this.querySelector('.eye-closed');
          
          if (input.type === 'password') {
            input.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
          } else {
            input.type = 'password';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
          }
        });
      });

      // Form validation
      const passwordInput = document.getElementById('password');
      const confirmPasswordInput = document.getElementById('confirm_password');
      const passwordError = document.getElementById('password_error');
      const confirmPasswordError = document.getElementById('confirm_password_error');
      const form = document.getElementById('passwordForm');

      const validatePassword = () => {
        const password = passwordInput.value.trim();
        
        if (!password) {
          passwordInput.classList.remove('border-blue-200');
          passwordInput.classList.add('border-red-300');
          passwordError.textContent = "Password is required";
          passwordError.classList.remove("hidden");
          return false;
        } else if (password.length < 8) {
          passwordInput.classList.remove('border-blue-200');
          passwordInput.classList.add('border-red-300');
          passwordError.textContent = "Password must be at least 8 characters";
          passwordError.classList.remove("hidden");
          return false;
        } else {
          passwordInput.classList.remove('border-red-300');
          passwordInput.classList.add('border-blue-200');
          passwordError.textContent = "";
          passwordError.classList.add("hidden");
          return true;
        }
      };

      const validateConfirmPassword = () => {
        const password = passwordInput.value.trim();
        const confirmPassword = confirmPasswordInput.value.trim();
        
        if (!confirmPassword) {
          confirmPasswordInput.classList.remove('border-blue-200');
          confirmPasswordInput.classList.add('border-red-300');
          confirmPasswordError.textContent = "Please confirm your password";
          confirmPasswordError.classList.remove("hidden");
          return false;
        } else if (password !== confirmPassword) {
          confirmPasswordInput.classList.remove('border-blue-200');
          confirmPasswordInput.classList.add('border-red-300');
          confirmPasswordError.textContent = "Passwords do not match";
          confirmPasswordError.classList.remove("hidden");
          return false;
        } else {
          confirmPasswordInput.classList.remove('border-red-300');
          confirmPasswordInput.classList.add('border-blue-200');
          confirmPasswordError.textContent = "";
          confirmPasswordError.classList.add("hidden");
          return true;
        }
      };

      passwordInput.addEventListener('input', () => {
        validatePassword();
        if (confirmPasswordInput.value.trim()) {
          validateConfirmPassword();
        }
      });

      confirmPasswordInput.addEventListener('input', () => {
        validateConfirmPassword();
      });

      // Form submission
      form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const isPasswordValid = validatePassword();
        const isConfirmPasswordValid = validateConfirmPassword();
        
        if (isPasswordValid && isConfirmPasswordValid) {
          form.submit();
        }
      });
    });