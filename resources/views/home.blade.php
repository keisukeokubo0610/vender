<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>ホーム画面</title>
</head>


<body>
    <div class="container">
        <div class="mt-5">
            {{-- @if(session('login_success'))
                <div class="alert alert-success">
                    {{ session('login_success') }}
                </div>
            @endif --}}
            <x-alert type="success" :session="session('success')" />


            <h3>ログイン成功！</h3>

            <ul>
                <li>名前：{{ Auth::user()->name }}</li>
                <li>メールアドレス：{{ Auth::user()->email }}</li>
            </ul>

            <form action="{{ Route('logout') }}" method="post">
                @csrf
                <button class="btn btn-danger">ログアウト</button>
            </form>


        </div>

    </div>

</body>
</html>