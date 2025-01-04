const dropdown = document.querySelector('.dropdown');
const dropdownContent = document.querySelector('.dropdown-content');

let hideTimeout;

function showDropdown() {
    clearTimeout(hideTimeout);
    dropdownContent.style.display = 'block';
}

function hideDropdown() {
    hideTimeout = setTimeout(() => {
        dropdownContent.style.display = 'none';
    }, 2000);
}

dropdown.addEventListener('mouseover', showDropdown);

dropdown.addEventListener('mouseleave', hideDropdown);

dropdownContent.addEventListener('mouseover', showDropdown);

dropdownContent.addEventListener('mouseleave', hideDropdown);
















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

