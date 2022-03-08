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


                </div>

                {{-- ソート --}}
                <table class="table table-hover">
                    <tr>
                        {{-- 商品ID --}}
                        <th class="sortable">
                            <button type="button" name="sort_item" value="id">商品ID asc</button>
                            <input class="sort_type" type="hidden" name="sort" value="asc">
                        </th>
                        <th class="sortable mr-3">
                            <button type="button" name="sort_item" value="id">商品ID desc</button>
                            <input class="sort_type" type="hidden" name="sort" value="desc">
                        </th>
                        {{-- ストック --}}
                        <th class="sortable">
                            <button type="button" name="sort_item" value="stock">Stock asc</button>
                            <input class="sort_type" type="hidden" name="sort" value="asc">
                        </th>
                        <th class="sortable">
                            <button type="button" name="sort_item" value="stock">Stock desc</button>
                            <input class="sort_type" type="hidden" name="sort" value="desc">
                        </th>
                        {{-- 価格 --}}
                        <th class="sortable">
                            <button type="button" name="sort_item" value="price">price asc</button>
                            <input class="sort_type" type="hidden" name="sort" value="asc">
                        </th>
                        <th class="sortable">
                            <button type="button" name="sort_item" value="price">price desc</button>
                            <input class="sort_type" type="hidden" name="sort" value="desc">
                        </th>
                    </tr>
                </table>

                {{-- 商品一覧ここで表示 --}}
                <div id="getProductsList" class="products-container">
                    {{-- <button id="addcontent" type="button">ここ！</button> --}}

                    <table id="product_table" class="table table-hover">
                        @csrf
                        <tbody>


                            {{-- ここにajax中身入る --}}


                        </tbody>
                    </table>
                </div>

                <h2>商品追加フォーム</h2>
                <div class="etc-login-form">
                    <a class="btn btn-success" href="{{ Route('showProductAdd') }}">商品新規登録</a>

                    <form action="{{ Route('logout') }}" method="post" class="container">
                        @csrf
                        <button class="mt-3 btn btn-danger">ログアウト</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
