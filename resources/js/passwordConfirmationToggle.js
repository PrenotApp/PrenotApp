document.addEventListener("DOMContentLoaded", function() {
    var showPasswordCheckbox = document.getElementById("showConfirmationPassword");
    var passwordField = document.getElementById("password-confirm");

    if (showPasswordCheckbox) {
        showPasswordCheckbox.addEventListener("change", function() {
            passwordField.type = showPasswordCheckbox.checked ? "text" : "password";
        });
    }
});
