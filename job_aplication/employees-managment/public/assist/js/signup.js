
  const countries = [
    { name: "United States", code: "us" },
    { name: "France", code: "fr" },
    { name: "Germany", code: "de" },
    { name: "Japan", code: "jp" },
    { name: "Saudi Arabia", code: "sa" },
    { name: "Egypt", code: "eg" },
    { name: "Morocco", code: "ma" },
    { name: "India", code: "in" },
    { name: "United Kingdom", code: "gb" },
    { name: "Brazil", code: "br" },
    { name: "Canada", code: "ca" },
    { name: "Spain", code: "es" },
    { name: "Italy", code: "it" },
    { name: "Russia", code: "ru" },
    { name: "China", code: "cn" },
    { name: "Mexico", code: "mx" },
    { name: "Turkey", code: "tr" },
    { name: "South Africa", code: "za" },
    { name: "Argentina", code: "ar" },
    { name: "Sweden", code: "se" },
    { name: "Netherlands", code: "nl" },
    { name: "Australia", code: "au" },
    { name: "Nigeria", code: "ng" },
    { name: "Pakistan", code: "pk" },
    { name: "Bangladesh", code: "bd" },
    { name: "Indonesia", code: "id" },
    { name: "South Korea", code: "kr" },
    { name: "Ukraine", code: "ua" },
    { name: "Iraq", code: "iq" },
    { name: "Philippines", code: "ph" },
    { name: "Vietnam", code: "vn" },
    { name: "Thailand", code: "th" },
    { name: "Malaysia", code: "my" }
  ];

  const select = document.getElementById("countries");

  countries.forEach(country => {
    const option = document.createElement("option");
    option.value = country.name;
    option.textContent = country.name;
    option.setAttribute("data-code", country.code);
    select.appendChild(option);
  });

  new TomSelect("#countries", {
    render: {
      option: function(data, escape) {
        return `<div>
                  <img class="inline w-5 h-4 mr-2" src="https://flagcdn.com/w40/${data.code}.png" />
                  ${escape(data.text)}
                </div>`;
      },
      item: function(data, escape) {
        return `<div>
                  <img class="inline w-5 h-4 mr-2" src="https://flagcdn.com/w40/${data.code}.png" />
                  ${escape(data.text)}
                </div>`;
      }
    }
  });


  const inputs = document.querySelectorAll(".input-control");
  const submitButton = document.getElementById("submit");
  const form = document.querySelector("form");
  

  const set_invalid = (input, message) => {
    input.classList.add("invalid");
    const parent = input.id === "password"
  ? input.parentElement.parentElement
  : input.parentElement;

    const error = parent.querySelector(".error");
    error.textContent = message;
    error.classList.remove("hidden");
  };
  

  const set_valid = (input) => {
    input.classList.remove("invalid");
    const parent = input.id === "password"
  ? input.parentElement.parentElement
  : input.parentElement;

    const error = parent.querySelector(".error");
    error.textContent = "";
    error.classList.add("hidden");
  };
  

  const validate_name = () => {
    const name = inputs[0].value.trim();
    const regex = /^[a-zA-Z]{2,}\s[a-zA-Z]{2,}$/;
    if (name === "") {
      set_invalid(inputs[0], "Name is required.");
      return false;
    } else if (name.length < 5) {
      set_invalid(inputs[0], "Please enter first and last name, at least 2 letters each.");
      return false;
    } else if (!regex.test(name)) {
      set_invalid(inputs[0], "Name must contain only letters with a single space in between.");
      return false;
    } else {
      set_valid(inputs[0]);
      return true;
    }
  };
  
  
  const validate_email = () => {
    const email = inputs[1].value.trim();
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (email === "") {
      set_invalid(inputs[1], "Email is required.");
      return false;
    } else if (!regex.test(email)) {
      set_invalid(inputs[1], "Please enter a valid email address.");
      return false;
    } else {
      set_valid(inputs[1]);
      return true;
    }
  };
  

  const validate_password = () => {
    const password = inputs[2].value.trim();
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    if (password === "") {
      set_invalid(inputs[2], "Password is required.");
      return false;
    } else if (password.length < 8) {
      set_invalid(inputs[2], "Password must be at least 8 characters long.");
      return false;
    } else if (!regex.test(password)) {
      set_invalid(inputs[2], "Password must contain at least one uppercase letter, one lowercase letter, and one number.");
      return false;
    } else {
      set_valid(inputs[2]);
      return true;
    }
  };
  

  const validate_confirm_password = () => {
    const password = inputs[2].value.trim();
    const confirmPassword = inputs[3].value.trim();
    if (confirmPassword === "") {
      set_invalid(inputs[3], "Confirm Password is required.");
      return false;
    } else if (confirmPassword !== password) {
      set_invalid(inputs[3], "Passwords do not match.");
      return false;
    } else {
      set_valid(inputs[3]);
      return true;
    }
  };
  

  const validate_select = () => {
    const select = document.getElementById("countries");
    if (!select) {
      console.error("Countries select element not found");
      return false;
    }
    
    if (select.value === "") {
      set_invalid(select, "Please select a country.");
      return false;
    } else {
      set_valid(select);
      return true;
    }
  };
  

  inputs[0].addEventListener("input", validate_name);
  inputs[1].addEventListener("input", validate_email);
  inputs[2].addEventListener("input", validate_password);
  inputs[3].addEventListener("input", validate_confirm_password);
  

  const countrySelect = document.getElementById("countries");
  if (countrySelect) {
    countrySelect.addEventListener("change", validate_select);
  }
  

  form.addEventListener("submit", function(event) {

    event.preventDefault();
    
 
    const nameValid = validate_name();
    const emailValid = validate_email();
    const passwordValid = validate_password();
    const confirmPasswordValid = validate_confirm_password();
    const countryValid = validate_select();
    

    let fileValid = true;
    const fileInput = document.querySelector('input[type="file"]');
    if (fileInput) {
      if (fileInput.files.length === 0) {
        const parent = fileInput.parentElement;
        const error = parent.querySelector(".error");
        if (error) {
          error.textContent = "Please select a CV file.";
          error.classList.remove("hidden");
          fileInput.classList.add("invalid");
        }
        fileValid = false;
      } else {
        const file = fileInput.files[0];
        const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        
        if (!allowedTypes.includes(file.type)) {
          const parent = fileInput.parentElement;
          const error = parent.querySelector(".error");
          if (error) {
            error.textContent = "Invalid file type. Please upload a PDF or Word document.";
            error.classList.remove("hidden");
            fileInput.classList.add("invalid");
          }
          fileValid = false;
        } else if (file.size > 5000000) { // 5MB limit
          const parent = fileInput.parentElement;
          const error = parent.querySelector(".error");
          if (error) {
            error.textContent = "File is too large. Maximum size is 5MB.";
            error.classList.remove("hidden");
            fileInput.classList.add("invalid");
          }
          fileValid = false;
        } else {
          const parent = fileInput.parentElement;
          const error = parent.querySelector(".error");
          if (error) {
            error.textContent = "";
            error.classList.add("hidden");
            fileInput.classList.remove("invalid");
          }
        }
      }
    }
    
  
    if (nameValid && emailValid && passwordValid && confirmPasswordValid && countryValid && fileValid) {

      form.removeEventListener("submit", arguments.callee);
    } else {

      const invalidFields = document.querySelectorAll('.invalid');
      if (invalidFields.length > 0) {
        invalidFields[0].focus();
      }
    }
  });
  

  document.addEventListener("DOMContentLoaded", function() {

    const errorMessages = document.querySelectorAll(".error:not(.hidden)");
    if (errorMessages.length > 0) {
  
      errorMessages.forEach(error => {
        const input = error.parentElement.querySelector("input, select");
        if (input) {
          input.classList.add("invalid");
        }
      });
    }
  });

  document.getElementById('cv').addEventListener('change', function(e) {
    const label = document.getElementById('cv-upload-label');
    const instructions = document.getElementById('upload-instructions');
    const fileSelected = document.getElementById('file-selected');
    const fileName = document.getElementById('file-name');
    
    if (this.files.length > 0) {
      
      label.classList.add('has-file');
      instructions.classList.add('hidden');
      fileSelected.classList.remove('hidden');
      fileName.textContent = this.files[0].name;
    } else {
  
      label.classList.remove('has-file');
      instructions.classList.remove('hidden');
      fileSelected.classList.add('hidden');
    }
  });




  const password = document.getElementById("password");
  const eye = document.getElementById("togglePassword");
  const icon = eye.querySelector("i");
  
  
  password.addEventListener("input", () => {
    if (password.value.length > 0) {
      eye.classList.remove("hidden");
    } else {
      eye.classList.add("hidden");
    }
  });
  
  
  eye.addEventListener("click", () => {
    if (password.type === "password") {
      password.type = "text";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    } else {
      password.type = "password";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    }
  });
  







  