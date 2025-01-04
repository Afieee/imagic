<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagic</title>
    <link rel="stylesheet" href="{{ asset('css/landing_page.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navigasi-bar">
        <a href="index.html" class="a-logo nav-items">
            <img src="{{ asset('storage/images/imagic_logo.png') }}" alt="Logo Unikom" class="logo-brand">
        </a>

        <a href="/login" class="nav-text nav-items">
            <center>
                <span><strong>Home</strong></span>
            </center>
        </a>

        <a href="/login" class="nav-text nav-items">
            <center>
                <span><strong>Create</strong></span>
            </center>
        </a>


        <div class="search-container">
            <input type="text" class="search-bar" placeholder="Search your color today...">
            <span class="search-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"
                    fill="#888">
                    <path
                        d="M10 2a8 8 0 105.293 14.707l5.32 5.32a1 1 0 001.415-1.415l-5.32-5.32A8 8 0 0010 2zm0 2a6 6 0 110 12A6 6 0 0110 4z" />
                </svg>
            </span>
        </div>

        <a href="/login" class="login">Log-in</a>
    </nav>

    <main class="main">
        {{ $slot }}
    </main>
</body>


<script src="{{ asset('js/landing_page.js') }}"></script>

</html>
