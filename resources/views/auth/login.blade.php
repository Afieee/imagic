<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Imagic | Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('storage/images/imagic_logo.png') }}" type="image/png">
</head>

<style>
    /* Toast Notification */
    .toast-success {
        position: fixed;
        top: 10%;
        left: 50%;
        transform: translateX(-50%);
        background-color: #4caf50;
        color: white;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        padding: 15px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        font-size: 14px;
        font-weight: 500;
        z-index: 1000;
        animation: slideIn 0.5s ease-out;
    }

    .toast-icon {
        font-size: 18px;
        color: #d4fdd4;
        margin-right: 10px;
    }

    .toast-close {
        cursor: pointer;
        font-size: 18px;
        color: white;
    }

    .toast-close:hover {
        color: #c1eac1;
    }
</style>

<body>
    <!-- Toast Notification for Success -->
    @if (session('success'))
        <div class="toast-success">
            <span class="toast-icon">&#10004;</span>
            <span class="toast-message">{{ session('success') }}</span>
            <span class="toast-close" onclick="closeToast()">&#10005;</span>
        </div>
    @endif

    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <a href="/" class="imagic-back">
                    <h1 class="imagic-back">Imagic</h1>
                </a>
            </div>
            <form action="/login-berhasil" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <input type="checkbox" id="showPasswordCheckbox" onclick="togglePasswordVisibility()"
                    style="cursor: pointer">
                <span for="checkbox " id="showPasswordSpan">Show Password</span>
                <button type="submit" class="login-btn">Login</button>
            </form>
            <div class="register-link">
                <p>Don't have an account? <a href="/register">Sign up</a></p>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>

    <script>
        // Toast functionality
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
    </script>
</body>

</html>
