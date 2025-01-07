<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Imagic | Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>

    @if (session('loginError'))
        <div class="toast-error">
            <span class="toast-icon">&#9888;</span> <!-- Ikon peringatan -->
            <span class="toast-message">{{ session('loginError') }}</span>
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
</body>

</html>
