<!DOCTYPE html>
<html lang="ja">

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <!-- All the files that are required -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VenderLoginページ</title>
</head>

<body>

    <!-- LOGIN FORM -->
    <div class="text-cente" style="padding:50px 0">
        <div class="logo text-center">login</div>
        <!-- Main Form -->
        <div class="login-form-1">
            <form method="post" id="login-form" class="text-left" action="{{ route('login') }}">
                @csrf
                <div class="login-form-main-message"></div>
                <div class="main-login-form">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <div class="login-group">
                        <div class="form-group">
                            <label for="email" class="sr-only">e-mail</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="email">
                        </div>
                        <div class="form-group">
                            <label for="lg_password" class="sr-only">Password</label>
                            <input type="password" class="form-control" id="lg_password" name="password"
                                placeholder="password">
                        </div>
                        {{-- <div class="form-group login-group-checkbox">
                            <input type="checkbox" id="lg_remember" name="lg_remember">
                            <label for="lg_remember">remember</label>
                        </div> --}}
                    </div>
                    <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                </div>
                <div class="etc-login-form ">
                    {{-- <p>forgot your password? <a href="#">click here</a></p> --}}
                    <p class="text-center btn-dark">新規登録はこちら→<a href="#">新規登録</a></p>
                </div>
            </form>
        </div>
        <!-- end:Main Form -->
    </div>



</body>

</html>
