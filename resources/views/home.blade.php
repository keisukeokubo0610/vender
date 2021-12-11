<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ホーム画面</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="mt-5">
            @if(session('login_success'))
                <div class="alert alert-success">
                    {{ session('login_success') }}
                </div>
            @endif

            <h3>プロフィール</h3>

            <ul>
                <li>名前：{{ Auth::users()->user_name }}</li>
                <li>メールアドレス：{{ Auth::users()->email }}</li>
            </ul>

        </div>

    </div>

</body>
</html>