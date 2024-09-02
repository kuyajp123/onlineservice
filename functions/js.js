// Save user preference to local storage
function setDarkModePreference(isDarkMode) {
    localStorage.setItem('darkMode', isDarkMode ? 'enabled' : 'disabled');
}

// Get user preference from local storage
function getDarkModePreference() {
    return localStorage.getItem('darkMode') === 'enabled';
}

// Apply the dark mode based on the user's preference
function applyDarkMode() {
    const isDarkMode = getDarkModePreference();
    document.body.classList.toggle('dark-mode', isDarkMode);

    const toggleButton = document.getElementById('toggle-dark-mode');
    if (toggleButton) {
        const buttonText = isDarkMode ? 'Light mode' : 'Dark mode';
        toggleButton.textContent = buttonText;
    }
}

// Toggle dark mode on button click
document.addEventListener('DOMContentLoaded', () => {
    applyDarkMode(); // Apply the theme when the page loads

    const toggleDarkModeButton = document.getElementById('toggle-dark-mode');
    if (toggleDarkModeButton) {
        toggleDarkModeButton.addEventListener('click', () => {
            const isDarkMode = !getDarkModePreference();
            setDarkModePreference(isDarkMode);
            applyDarkMode(); // Reapply the mode and update button text
        });
    }
});