document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("textarea").forEach((textarea) => {
        textarea.addEventListener("input", function () {
            const maxLength = this.getAttribute("maxlength");
            const currentLength = this.value.length;
            const charCount = this.nextElementSibling;
            charCount.textContent = `Characters left: ${
                maxLength - currentLength
            }`;
        });
    });
});

const TIMEOUT_MS = 3000; // 3 seconds

// Function to remove the alert after TIMEOUT_MS milliseconds
function removeAlert(alertId) {
    setTimeout(() => {
        let alert = document.getElementById(alertId);
        if (alert) {
            alert.remove();
        }
    }, TIMEOUT_MS);
}

// Remove error alert after timeout
let errorAlert = document.getElementById("errorAlert");
if (errorAlert) {
    removeAlert("errorAlert");
}

// Remove success alert after timeout
let successAlert = document.getElementById("successAlert");
if (successAlert) {
    removeAlert("successAlert");
}

