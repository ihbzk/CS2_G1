document.addEventListener("DOMContentLoaded", function () {
    var showPassword = document.getElementById("show-password");
    var passwordInput = document.getElementById("password");

    showPassword.addEventListener("click", function () {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }

        showPassword.classList.toggle("fa-eye-slash");
        showPassword.classList.toggle("fa-eye");
    });
});