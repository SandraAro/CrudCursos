<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- favicon -->
    <!-- estilos -->
    @livewireStyles
    @vite(['resources/js/app.js','resources/sass/app.scss'])
</head>
<body>
    <!-- header -->
    <!-- nav -->
    @yield('content')

    <!-- footer -->

    <!-- script -->
    @livewireScripts
    <script src="/livewire/livewire.js"></script>
</body>
</html>
