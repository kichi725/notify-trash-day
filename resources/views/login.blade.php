{{-- <x-base> --}}

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログインページ</title>
</head>
<body>
    <h2>ログインページ</h2>

    <form action="{{ route('login') }}" method="post">
        @csrf
        <div>
            <input type="text" name="email" id="email" placeholder="メールアドレス">
        </div>
        <div>
            <input type="password" name="password" id="password" placeholder="パスワード">
        </div>
        <button>ログイン</button>
    </form>

    {{-- ログインしたら以下を表示 --}}
    @auth
        <p>ログインしました。</p>
    @endauth
</body>
</html>
{{-- </x-base> --}}
