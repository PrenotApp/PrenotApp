document.addEventListener("DOMContentLoaded", function() {
    var showPasswordCheckbox = document.getElementById("showPassword");
    var passwordField = document.getElementById("password");

    if (showPasswordCheckbox) {
        showPasswordCheckbox.addEventListener("change", function() {
            passwordField.type = showPasswordCheckbox.checked ? "text" : "password";
        });
    }
});
