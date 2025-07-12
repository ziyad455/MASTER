    document.addEventListener("DOMContentLoaded", function() {
      const emailInput = document.getElementById("email");
      const emailError = document.getElementById("email-error");
      const form = document.getElementById("emailForm");

      // Email validation function
      const validateEmail = () => {
        const email = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!email) {
          emailInput.classList.remove('border-blue-200');
          emailInput.classList.add('border-red-300');
          emailError.textContent = "Email is required";
          emailError.classList.remove("hidden");
          return false;
        } else if (!emailRegex.test(email)) {
          emailInput.classList.remove('border-blue-200');
          emailInput.classList.add('border-red-300');
          emailError.textContent = "Please enter a valid email address";
          emailError.classList.remove("hidden");
          return false;
        } else {
          emailInput.classList.remove('border-red-300');
          emailInput.classList.add('border-blue-200');
          emailError.textContent = "";
          emailError.classList.add("hidden");
          return true;
        }
      };

      // Real-time validation
      emailInput.addEventListener("input", () => {
        if (emailInput.value.trim()) {
          validateEmail();
        } else {
          // Reset to default state when empty
          emailInput.classList.remove('border-red-300');
          emailInput.classList.add('border-blue-200');
          emailError.textContent = "";
          emailError.classList.add("hidden");
        }
      });

      // Form submission handler
      form.addEventListener("submit", function(event) {
        event.preventDefault();
        const isValid = validateEmail();
        
        if (isValid) {
          form.submit();
        }
      });
    });