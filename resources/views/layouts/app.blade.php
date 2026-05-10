<!DOCTYPE html>
<!-- Tambahkan scroll-smooth agar klik menu navbar pindah ke section dengan halus -->
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Toko Laptop Premium') | E-Market Laptop</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#09090b] text-gray-100 selection:bg-blue-500 selection:text-white">

    <x-navbar />

    <main>
        @yield('content')
    </main>

    <x-footer />

</body>

</html>
