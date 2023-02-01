<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    @include('components.navbar')
    @yield('content')
    @include('components.footer')
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('js')
</body>

</html>
