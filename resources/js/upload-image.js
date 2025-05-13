document.addEventListener('DOMContentLoaded', function() {
    const avatarInput = document.getElementById('avatar');
    const avatarPreview = document.getElementById('avatar-preview');
    
    avatarInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                // Clear the preview div
                avatarPreview.innerHTML = '';
                
                // Create an image element
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover';
                img.alt = 'Profile Preview';
                
                // Add image to preview
                avatarPreview.appendChild(img);
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });
});