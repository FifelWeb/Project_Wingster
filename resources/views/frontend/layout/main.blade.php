<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title', 'Wingster | Modern Business')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets-fe/assets/favicon.ico') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets-fe/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-fe/css/custom-styles.css') }}" rel="stylesheet" /> {{-- Penting: Link ke CSS Kustom Anda --}}

</head>
<body class="d-flex flex-column h-100">
<main class="flex-shrink-0">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark main-navbar"> {{-- Tambahkan kelas main-navbar --}}
        <div class="container px-5">
            <a class="navbar-brand logo" href="{{ route('root') }}">Wingster</a> {{-- Logo link ke root --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home.index') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('booking.index') }}">Reservation</a></li>
                    @auth
                        <li class="nav-item">
                            <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Logout</button> {{-- Menggunakan btn-link untuk styling --}}
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('auth.login') }}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

</main>

<footer class="bg-dark py-4 mt-auto main-footer"> {{-- Tambahkan kelas main-footer --}}
    <div class="container px-5">
        <div class="row align-items-center justify-content-between flex-column flex-sm-row">
            <div class="col-auto">
                <div class="small m-0 text-white">Copyright © Wingster {{ date('Y') }}</div>
            </div>
            <div class="col-auto">
                <a class="link-light small" href="#">Privacy</a>
                <span class="text-white mx-1">·</span>
                <a class="link-light small" href="#">Terms</a>
                <span class="text-white mx-1">·</span>
                <a class="link-light small" href="{{ route('contact') }}">Contact</a> {{-- Link contact di footer --}}
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets-fe/js/scripts.js') }}"></script>
</body>
</html>
