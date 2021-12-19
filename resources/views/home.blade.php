@extends('template')

@section('title', 'ユーザー新規登録')
@section('description', 'ユーザー登録のページ')
    @include('head')

@section('content')

    <div class="container">
        <div class="mt-5">
            {{-- @if (session('login_success'))
                <div class="alert alert-success">
                    {{ session('login_success') }}
    </div>
    @endif --}}
            <x-alert type="success" :session="session('success')" />


            <p class="text-right">ようこそ {{ Auth::user()->name }} さん！</p>

            {{-- 検索フォーム --}}
            <div class="container">
                <h2>商品一覧画面</h2>

                <table class="table table-hover">
                    @foreach ($products as $product)
                        <tr>
                            <th>id：{{ $product->id }}</th>
                            <th>商品画像：<img src="{{ '/storage/' . $product->img_path }}" alt="商品画像"></th>
                            <th>商品名：{{ $product->product_name }}</th>
                            <th>価格：{{ $product->price }}</th>
                            <th>在庫数：{{ $product->stock }}</th>
                            <th>メーカー名：{{ $product->company_name }}</th>
                            <th><a href="/product/{{ $product->id }}" class="btn btn-primary">詳細</a></th>
                            
                            <form action="{{route('productDelete' ,$product->id) }}" method="POST">
                           @csrf
                            <th><button type="submit" class="btn btn-danger" onClick="delete_alert(event);return false;">削除</button></th>
                        </form>
                        </tr>
                    @endforeach

                </table>


                <div class="etc-login-form">
                    <h2>商品追加フォーム</h2>
                    <p class="text-center btn-dark mt-2">商品新規登録はこちら → <button><a href="{{ route('showProductAdd') }}">新規登録</a></button></p>
                </div>


                <h2>商品検索フォーム</h2>
                <form action="#" method="post">
                    @csrf
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
@endsection
