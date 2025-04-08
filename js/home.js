const adminBtn = document.querySelector("#adminBtn");
const adminInput = document.querySelector("#adminInput");
const userBtn = document.querySelector("#userBtn");
const userInput = document.querySelector("#userInput");
const userLoginBtn = document.querySelector("#userLoginBtn");
const adminLoginBtn = document.querySelector("#adminLoginBtn");
const userTypeInput = document.querySelector("#userType");

userBtn.addEventListener("click", () => {
  userInput.classList.remove("hidden");
  adminInput.classList.add("hidden");
  adminLoginBtn.classList.add("hidden");
  userLoginBtn.classList.remove("hidden");
  userTypeInput.value = "user";
});

adminBtn.addEventListener("click", () => {
  adminInput.classList.remove("hidden");
  userInput.classList.add("hidden");
  userLoginBtn.classList.add("hidden");
  adminLoginBtn.classList.remove("hidden");
  userTypeInput.value = "admin";
});

// Initialize the form to show user login by default
document.addEventListener("DOMContentLoaded", function () {
  // Set default user type
  if (userTypeInput) {
    userTypeInput.value = "user";
  }

  // Show user login form by default
  if (userInput && adminInput) {
    userInput.classList.remove("hidden");
    adminInput.classList.add("hidden");
  }

  if (userLoginBtn && adminLoginBtn) {
    userLoginBtn.classList.remove("hidden");
    adminLoginBtn.classList.add("hidden");
  }
});
