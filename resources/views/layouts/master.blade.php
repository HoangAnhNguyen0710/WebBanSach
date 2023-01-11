<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body>
<div class="container-fluid pt-2">
    @include('components.search')
    @include('components.topbar')
    @include('components.header')
    @yield('content')
    @include('components.footer')
</div>
<script src="{{ asset('js/app.js') }}" defer></script>
@stack('js')
</body>
</html>
