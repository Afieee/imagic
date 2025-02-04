<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagic</title>
    <link rel="stylesheet" href="{{ asset('css/landing_page.css') }}">
    <link rel="icon" href="{{ asset('storage/images/imagic_logo.png') }}" type="image/png">

    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navigasi-bar">
        <a href="/login" class="a-logo nav-items">
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

        </div>
        <div class="search-container">
        </div>

        <a href="/login" class="login" style="text-decoration:none; color:black;">Log-in</a>
    </nav>

    <main class="main">
        {{ $slot }}
    </main>
</body>


<script>
    document.querySelector('.search-bar').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.getElementById('searchForm').submit();
        }
    });
</script>
<script src="{{ asset('js/landing_page.js') }}"></script>

</html>
