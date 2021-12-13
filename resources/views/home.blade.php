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
            {{-- @if (session('login_success'))
                <div class="alert alert-success">
                    {{ session('login_success') }}
                </div>
            @endif --}}
            <x-alert type="success" :session="session('success')" />


            <p>ようこそ {{ Auth::user()->name }} さん！</p>

            {{-- 検索フォーム --}}
            <div class="container">
                <h2>商品一覧画面</h2>

                <table class="table table-hover">
                    @foreach ($results as $result)
                        <tr>
                            <th>id：{{ $result->id }}</th>
                            {{-- <th>商品画像：{{ $product-> }}</th> --}}
                            <th>商品名：{{ $result->product_name }}</th>
                            <th>価格：{{ $result->price }}</th>
                            <th>在庫数：{{ $result->stock }}</th>
                            <th>メーカー名：{{ $result->company_name }}</th>
                            <th><button class="btn btn-primary">詳細</button></th>
                        </tr>
                    @endforeach

                </table>

                <h2>商品検索フォーム</h2>
                <form action="#" method="post">
                    <p>商品名：<input type="text" name="product_name"></input></p>
                    <p>メーカー名：
                        <select name="example">
                            <option value="サンプル1">サンプル1</option>
                            <option value="サンプル2">サンプル2</option>
                            <option value="サンプル3">サンプル3</option>
                        </select>
                    </p>

                    <div class="button_wrapper remodal-bg">
                        <button type="submit" class="btn btn-primary" value="">検索</button>
                        　<button id="square_btn" onClick="history.back()">戻る</button>
                    </div>
                </form>
            </div>




            <form action="{{ Route('logout') }}" method="post">
                @csrf
                <button class="mt-3 btn btn-danger">ログアウト</button>
            </form>


        </div>

    </div>

</body>

</html>
