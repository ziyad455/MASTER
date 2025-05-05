
  const form = document.querySelector("form");

  form.addEventListener("submit", function (e) {
    form.querySelectorAll(".error-msg").forEach(el => el.remove());
    form.querySelectorAll("input, textarea, select").forEach(input => {
      input.classList.remove("border-red-500");
    });

    let hasError = false;

    function showError(input, message) {
      const error = document.createElement("p");
      error.className = "error-msg text-sm text-red-600 mt-1";
      error.innerText = message;
      input.classList.add("border-red-500");
      input.parentNode.appendChild(error);
      hasError = true;
    }

    const title = form.querySelector("#title");
    if (title.value.trim() === "") {
      showError(title, "Title is required.");
    }

    const dueDate = form.querySelector("#due_date");
    if (dueDate.value.trim() === "") {
      showError(dueDate, "Due date is required.");
    }

    const assignedTo = form.querySelector("#assigned_to");
    if (assignedTo.value === "") {
      showError(assignedTo, "Please select an employee.");
    }

    if (hasError) {
      e.preventDefault();
    }
  });

