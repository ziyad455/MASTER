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
