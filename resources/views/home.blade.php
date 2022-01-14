@extends('template')

@section('title', 'ホーム画面')
@section('description', 'ホーム画面です。')
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
                <h2 class="getProductsList">商品一覧画面</h2>



                <div class="search-container products-index-wrapper">

                    {{-- キーワード検索 --}}
                    <div class="search-group">
                        {{-- <form class="search-form" action="{{ route('productSearch') }}"> --}}
                            <label for="search_name"></label>

                        <input id="search_name" type="text" name="search_name" placeholder="キーワード検索">
                        <button id="getName" type="button" class="btn btn-success">検索する</button>
                        {{-- </form> --}}
                    </div>


                    

                    {{-- メーカー検索 --}}
                    <div class="search-group">
                        {{-- <form class="search-form" action="{{ route('companySearch') }}"> --}}
                            <label for="company_name" class="sr-only">メーカー名</label>

                            <select name="company_name" id="company_name">
                                <option value="" selected>メーカーをしてください</option>
                                @foreach ($makers as $maker)
                                    <option value="{{ $maker->company_name }}">{{ $maker->company_name }}</option>
                                @endforeach
                            </select>
                            <button id="getMaker" type="button" class="btn btn-success">検索する</button>
                        {{-- </form> --}}
                    </div>



                    {{-- 価格検索 --}}
                    <div class="search-group">

                            <select name="price" id="search_price">
                                <option value="" selected>価格を指定してください</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->price }}">{{ $product->price }}</option>
                                @endforeach
                            </select>

                            <button id="getPrice" type="button" class="btn btn-success">検索する</button>
                        {{-- </form> --}}
                    </div>

                    {{-- 在庫検索 --}}
                    <div class="search-group">
                        {{-- <form class="search-form" action="{{ route('stockSearch') }}"> --}}
                            <label for="search_stock"></label>
                            {{-- <input id="search_stock" type="text" name="stock" placeholder="在庫検索" value="{{ $product->stock }}"> --}}
                            <input id="search_stock" type="text" name="stock" placeholder="在庫検索">
                            <button id="getStock" type="button" class="btn btn-success">検索する</button>
                        {{-- </form> --}}
                    </div>


                    {{-- <form action="{{ route('index') }}" method='get'>
                        @csrf
                        <button type="submit" name="sort" class="btn">@sortablelink('id', 'id')</button>
                        <button type="submit" name="sort" class="btn">@sortablelink('price', '価格')</button>
                        <button type="submit" name="sort" class="btn">@sortablelink('stock', '在庫数')</button>
                    </form> --}}
                </div>

                {{-- 商品一覧ここで表示 --}}
                <div id="getProductsList" class="products-container">
                    {{-- <button id="addcontent" type="button">ここ！</button> --}}


                    <table id="product_table" class="table table-hover">
                        @csrf
                        <tbody>
                        {{-- @foreach ($products as $product)
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

                                <th><button id="deleteTarget" data-product-id="{{ $product->id }}" class="btn btn-danger" onClick="delete_alert(event);return false;">削除</button></th>
                                </form>
                                <br>
                            </tr>
                        @endforeach --}}
                        </tbody>
                    </table>
                </div>

                <h2>商品追加フォーム</h2>
                <div class="etc-login-form">
                    <a class="btn btn-success" href="{{ route('showProductAdd') }}">商品新規登録</a>


                    <form action="{{ Route('logout') }}" method="post" class="container">
                        @csrf
                        <button class="mt-3 btn btn-danger">ログアウト</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
