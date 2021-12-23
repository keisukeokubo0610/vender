@extends('template')

@section('title', 'ユーザー新規登録')
@section('description', 'ユーザー登録のページ')
    @include('head')

@section('content')

    <div class="container">
        <div class="mt-5">


            {{-- アラート表示 --}}
            <x-alert type="success" :session="session('success')" />
            <x-alert type="danger" :session="session('danger')" />


            <p class="text-right">ようこそ {{ Auth::user()->name }} さん！</p>

            {{-- 検索フォーム --}}
            <div class="container">
                <h2>商品一覧画面</h2>

                {{-- キーワード検索 --}}

                <div class="search-container">

                    <form class="search-form" action="{{ route('productSearch') }}">
                        @csrf
                        <input type="text" name="word" placeholder="キーワード検索">
                        <button type="submit" class="btn btn-success">検索する</button>
                    </form>


                    {{-- メーカー検索 --}}
                    <form class="search-form" action="{{ route('companySearch') }}">
                        <label for="company_name" class="sr-only">メーカー名</label>

                        <select name="company_name" id="company_name">
                            <option value="" selected>選択してください</option>
                            @foreach ($makers as $maker)
                                <option value="{{ $maker->company_name }}">{{ $maker->company_name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-success">検索する</button>
                    </form>

                </div>


                <div class="products-container">
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

                                <form class="form-inline btn" action="{{ route('productDelete', $product->id) }}"
                                    method="POST">
                                    @csrf
                                    <th><button type="submit" class="btn btn-danger"
                                            onClick="delete_alert(event);return false;">削除</button></th>
                                </form>
                                <br>
                            </tr>
                        @endforeach

                    </table>
                </div>

                {{-- <div class="d-flex justify-content-center ">
                    {{ $pagenate->links() }}
                </div> --}}


                <div class="etc-login-form">
                    <h2>商品追加フォーム</h2>
                    <p class="text-center btn btn-dark mt-2">商品新規登録はこちら → <button><a
                                href="{{ route('showProductAdd') }}">新規登録</a></button></p>
                </div>


                <form action="{{ Route('logout') }}" method="post" class="container">
                    @csrf
                    <button class="mt-3 btn btn-danger">ログアウト</button>
                </form>
            </div>
        </div>
    @endsection
