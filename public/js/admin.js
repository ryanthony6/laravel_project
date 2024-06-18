document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('textarea').forEach((textarea) => {
        textarea.addEventListener('input', function () {
            const maxLength = this.getAttribute('maxlength');
            const currentLength = this.value.length;
            const charCount = this.nextElementSibling;
            charCount.textContent = `Characters left: ${maxLength - currentLength}`;
        });
    });
});