
    const textarea = document.getElementById('comment');
    const charCount = document.getElementById('charCount');
    
    textarea.addEventListener('input', function() {
        const maxLength = parseInt(textarea.getAttribute('maxlength'));
        const currentLength = textarea.value.length;
        const charactersLeft = maxLength - currentLength;
        
        charCount.textContent = `Characters left: ${charactersLeft}`;
    });

    