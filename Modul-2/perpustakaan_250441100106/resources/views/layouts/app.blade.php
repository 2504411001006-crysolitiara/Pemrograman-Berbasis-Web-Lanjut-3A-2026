<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Perpustakaan')</title> 

    @vite(['resources/css/app.css']) 
</head>

<body>

    <header>
        <div class="container">
            <h1>Perpustakaan</h1>

            <nav>
                <a href="{{ route('home') }}">Beranda</a>
                <a href="{{ route('buku.index') }}">Daftar Buku</a>
            </nav>
        </div>
    </header>

    <main class="container">
        @yield('content') 
    </main>

    <footer>
        <p>&copy; 2026 Perpustakaan</p>
    </footer>

</body>

</html>