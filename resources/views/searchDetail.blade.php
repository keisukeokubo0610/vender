@extends('template')

@section('title', '商品詳細')
@section('description', '商品詳細のページ')
    @include('head')

@section('content')

    <div class="container">
        <div class="mt-5">
            <p class="text-right">ようこそ {{ Auth::user()->name }} さん！</p>

            {{-- 検索フォーム --}}
            <div class="container">
                <h2>商品詳細画面</h2>


                @if (session('err_msg'))
                    <p class="text-danger">
                        {{ session('err_msg') }}
                    </p>
                @endif

                <table class="table table-hover">
                    <tr>
                        <th>id：{{ $product->id }}</th>
                        <th>商品画像：<img src="{{ '/storage/' . $product->img_path }}" alt="商品画像" class="w-10 "></th>
                        <th>商品名：{{ $product->product_name }}</th>
                        @foreach ($results as $result)
                            <th>メーカー：{{ $result->company_name }}</th>
                        @endforeach
                        <th>価格：{{ $product->price }}</th>
                        <th>在庫数：{{ $product->stock }}</th>
                        <th>コメント：{{ $product->comment }}</th>
                        <th><a href="{{ route('showUpdate', $product->id) }}" class="btn btn-primary">編集</a></th>
                        <th>
                            <form method="POST" action="{{ route('stockAPI') }}" class="btn text-left">
                                <input value="{{ $product->id }}" type="hidden" name="id">
                                <button value="{{ $product->stock }}" type="submit" class="form-control" name="product_stock">購入</button>
                                @csrf
                            </form>

                    </tr>

                </table>

            </div>

            <div class="etc-login-form">
                <a class="btn btn-success" href="{{ route('searchProductlist') }}">商品一覧に戻る</a>
            </div>
            {{-- <button id="square_btn" onClick="history.back()">戻る</button> --}}

        </div>
    </div>
