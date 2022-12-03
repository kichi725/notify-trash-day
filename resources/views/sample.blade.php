<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sample Page</title>
</head>
<body>
    <h1>Sample Page</h1>
    @php
        $d = new \Carbon\Carbon();
    @endphp
    <h2>{{ $d->format('Y-m-d') }}</h2>
</body>
</html>
