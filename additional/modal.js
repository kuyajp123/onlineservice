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
