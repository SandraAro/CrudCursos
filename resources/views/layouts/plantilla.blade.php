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
    <h1 class="fs-1 text">Bienvenidos a mi Mini Market</h1>

    @yield('content')

    <!-- footer -->

    <!-- script -->
    @livewireScripts
</body>
</html>
