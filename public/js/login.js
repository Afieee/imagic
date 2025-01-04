function togglePasswordVisibility() {

    const password = document.getElementById('password');
    const showPasswordCheckbox = document.getElementById('showPasswordCheckbox');


    if (showPasswordCheckbox.checked) {
        password.type = 'text';
    } else {
        password.type = 'password';
    }
}

function togglePasswordVisibilitySpan() {

    const showPasswordSpan = document.getElementById('showPasswordSpan');
    if (showPasswordSpan.checked) {
        password.type = 'text';
    } else {
        password.type = 'password';
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
