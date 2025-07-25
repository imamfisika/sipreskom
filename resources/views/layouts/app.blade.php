<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="icon" href="{{ asset('images/unj.png') }}" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    <main class="sm:ml-64 pl-20 pt-12 pr-12 overflow-auto scroll-smooth bg-gray-50 h-screen">
        @yield('content')
        <br><br>

    </main>

</body>
</html>
