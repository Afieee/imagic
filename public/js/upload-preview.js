// Function to preview the image before uploading
function previewImage(event) {
    const output = document.getElementById('imagePreview');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const imgElement = document.createElement('img');
            imgElement.src = e.target.result;
            output.innerHTML = ''; // Clear any previous preview
            output.appendChild(imgElement); // Append the new image preview
        };
        reader.readAsDataURL(file); // Read the selected file as Data URL
    }
}


// TOAST PENTING
function closeToast() {
    const toast = document.querySelector('.toast-error');
    if (toast) {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }
}
setTimeout(closeToast, 5000);








// TOAST
function closeToast() {
    const toast = document.querySelector('.toast-success');
    if (toast) {
        fadeOutAndRemoveToast(toast);
    }
}

function fadeOutAndRemoveToast(toast) {
    toast.style.animation = 'fadeOut 0.5s ease-out forwards';

    setTimeout(() => {
        if (toast.parentNode) {
            toast.parentNode.removeChild(toast);
        }
    }, 500);
}

document.addEventListener('DOMContentLoaded', () => {
    const toast = document.querySelector('.toast-success');
    if (toast) {
        setTimeout(() => fadeOutAndRemoveToast(toast), 1500);
    }
});

const style = document.createElement('style');
style.innerHTML = `
    @keyframes fadeOut {
        to {
            opacity: 0;
            transform: translateY(-10%);
        }
    }
`;
document.head.appendChild(style);

