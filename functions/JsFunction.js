





// show password
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector(".toggle-password").addEventListener("click", function() {
        var passwordField = document.getElementById("user_password");
        var type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
        this.querySelector("i").classList.toggle("fa-eye");
        this.querySelector("i").classList.toggle("fa-eye-slash");
    });
});




// show modal
function openModal(modalId) {
    const modalElement = document.getElementById(modalId);
    if (modalElement) {
        $(modalElement).modal('show');
    } else {
        console.error(`Modal with ID ${modalId} not found.`);
    }
}

// Event listeners for elements that should open modals
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[data-open-modal]').forEach(element => {
        element.addEventListener('click', function(event) {
            const modalId = element.getAttribute('data-open-modal');
            openModal(modalId);
        });
    });
});
