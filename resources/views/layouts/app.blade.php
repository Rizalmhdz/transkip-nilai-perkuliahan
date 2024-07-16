<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Style untuk membuat header sticky */
        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #ffffff; /* Sesuaikan dengan warna latar belakang Anda */
            border-bottom: 1px solid #e5e7eb; /* Garis bawah header */
        }

        /* Style untuk membuat sidebar sticky */
        .sticky-sidebar {
            position: sticky;
            top: 64px; /* Jarak dari atas setara dengan tinggi header */
            height: calc(100vh - 64px); /* 64px adalah tinggi header */
            overflow-y: auto; /* Mengaktifkan scroll jika konten lebih panjang dari tinggi sidebar */
            z-index: 100;
            background-color: #f3f4f6; /* Sesuaikan dengan warna latar belakang Anda */
            border-right: 1px solid #e5e7eb; /* Garis kanan sidebar */
        }

        /* Style untuk konten utama */
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Header -->
        <header class="sticky-header">
            @include('layouts.navigation')
        </header>
           
        <!-- Sidebar dan Konten Utama -->
        <div x-data="{ isSidebarOpen: window.innerWidth > 768 }" @resize.window="isSidebarOpen = window.innerWidth > 768 ? true : false" class="d-flex">
            <!-- Sidebar ketika ukuran layar desktop -->
            <div :class="isSidebarOpen ? 'sidebar-expand sticky-sidebar' : 'sidebar-collapse sticky-sidebar'" class="bg-body-tertiary p-3 flex-shrink-0">
                @include('components.sidebar-admin')
            </div>

            <!-- Konten utama -->
            <div class="main-content">
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });
        </script>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
