document.addEventListener("DOMContentLoaded", function () {
    const input = document.querySelectorAll("input");
    const nameInput = input[0];
    const lastNameInput = input[1];
    const nameError = document.getElementById("name_error");
    const lastNameError = document.getElementById("last_name_error");
    const form = document.querySelector("form");
    let formSubmitted = false;

    // Helper functions for validation states
    const setValid = (input, errorElement) => {
    
            input.classList.remove('border-red-300');
            input.classList.add('border-blue-200');
        
        errorElement.textContent = "";
        errorElement.classList.add("hidden");
    };

    const setInvalid = (input, errorElement, message) => {
    
            input.classList.remove('border-blue-200');
            input.classList.add('border-red-600');
        
        errorElement.textContent = message;
        errorElement.classList.remove("hidden");
    };

    // Validation functions
    const validateName = () => {
        const name = nameInput.value.trim();
        
        if (!name) {
            setInvalid(nameInput, nameError, "First name is required");
            return false;
        } else if (name.length < 3) {
            setInvalid(nameInput, nameError, "First name must be at least 3 characters");
            return false;
        } else if (!/^[a-zA-Z]+$/.test(name)) {
            setInvalid(nameInput, nameError, "First name should contain only letters");
            return false;
        } else {
            setValid(nameInput, nameError);
            return true;
        }
    };

    const validateLastName = () => {
        const lastName = lastNameInput.value.trim();
        
        if (!lastName) {
            setInvalid(lastNameInput, lastNameError, "Last name is required");
            return false;
        } else if (lastName.length < 3) {
            setInvalid(lastNameInput, lastNameError, "Last name must be at least 3 characters");
            return false;
        } else if (!/^[a-zA-Z]+$/.test(lastName)) {
            setInvalid(lastNameInput, lastNameError, "Last name should contain only letters");
            return false;
        } else {
            setValid(lastNameInput, lastNameError);
            return true;
        }
    };

    // Event listeners for real-time validation (only shows error text)
    nameInput.addEventListener("input", () => {
        if (nameInput.value.trim()) {
            validateName();
        } else {
            nameError.textContent = "";
            nameError.classList.add("hidden");



        }
    });

    lastNameInput.addEventListener("input", () => {
        if (lastNameInput.value.trim()) {
            validateLastName();
        } else {
            lastNameError.textContent = "";
            lastNameError.classList.add("hidden");

        }
    });


    form.addEventListener("submit", function (event) {
        event.preventDefault();
        formSubmitted = true;

        const isNameValid = validateName();
        const isLastNameValid = validateLastName();

        if (isNameValid && isLastNameValid) {
            form.submit();
        }
    });
});