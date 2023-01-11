<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel開発</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="vue-app" class="container">
        {{ $slot }}
        {{-- @yield('content') --}}
    </div>
</body>
</html>
