<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('fe/img/tokoCodingKost.png') }}" type="image/png">

    <title>Toko Coding Kost</title>

    @include('partials.style')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    @stack('after-style')
    <!-- Styles -->
</head>
<body>
    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('partials.footer')
    @include('partials.script')
    @stack('after-script')
</body>
</html>
