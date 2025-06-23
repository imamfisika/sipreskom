{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        @isset($header)
            <header class="bg-green-700 text-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            @endisset
            @if(auth()->user()->role === 'mahasiswa')
            @include('components.sidebarMhs')
            @elseif(auth()->user()->role === 'admin')
            @include('components.sidebarDsn')
            @elseif(auth()->user()->role === 'superadmin')
            @include('components.sidebarAdm')
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIPRESKOM')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom CSS (jika ada) --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">SIPRESKOM</a>
            @auth
                <div class="ms-auto text-white">
                    Selamat datang, {{ Auth::user()->nama }} ({{ Auth::user()->role }})
                </div>
            @endauth
        </div>
    </nav>

    {{-- Flash Message --}}
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
    </div>

    {{-- Main Content --}}
    <main class="container">
        @yield('content')
    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>