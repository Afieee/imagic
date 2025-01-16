<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Imagic | Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('storage/images/imagic_logo.png') }}" type="image/png">

</head>

<body>
    <div class="register-container">
        <div class="register-box">
            <div class="logo">
                <a href="/" class="imagic-back">
                    <h1>Imagic</h1>
                </a>
            </div>
            <form action="/register-berhasil" method="POST">
                @csrf
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Create a password" required>
                </div>

                <button type="submit" class="register-btn">Register</button>
            </form>
            <div class="login-link">
                <p>Already have an account? <a href="/login">Login</a></p>
            </div>
        </div>
    </div>
</body>

</html>
