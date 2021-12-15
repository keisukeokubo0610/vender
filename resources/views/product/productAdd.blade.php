@extends('template')

@section('title', '商品新規登録')
@section('description', '商品登録のページ')
    @include('head')

@section('content')

    <!-- REGISTRATION FORM -->
    <div class="text-center" style="padding:50px 0">
        <div class="logo">商品新規登録画面</div>
        <!-- Main Form -->
        <div class="login-form-1">
            <form method="POST" action="{{ route('productAdd') }}" id="register-form" class="text-left" enctype="multipart/form-data>
                @csrf

                <div class="main-login-form">
                    <div class="login-group">



                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- 商品名 --}}
                        <div class="form-group">
                            <label for="product_name" class="sr-only">name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="商品名">
                        </div>

                        {{-- メーカー名 --}}
                        <div class="form-group">
                            <select name="company_name" id="company_name">
                                @foreach ($makers as $maker) 
                                <option value="{{ $maker->company_id }}">{{ $maker->company_name }}</option>    
                                @endforeach
                            </select>
                        </div>

                        {{-- 価格 --}}
                        <div class="form-group">
                            <label for="price" class="sr-only">price</label>
                            <input type="text" class="form-control" id="price" name="price"
                                placeholder="価格">
                        </div>
                        {{-- 在庫数 --}}
                        <div class="form-group">
                            <label for="stock" class="sr-only">stock</label>
                            <input type="text" class="form-control" id="stock"
                                name="stock" placeholder="在庫数">
                        </div>

                        {{-- コメント --}}
                        <div class="form-group">
                            <label for="comment" class="sr-only">comment</label>
                            <input type="comment" class="form-control" id="comment"
                                name="text" placeholder="comment">
                        </div>

                        {{-- 画像 --}}
                        <div class="form-group">
                            <label for="img_path" class="sr-only">img_path</label>
                            <input type="file" name="img_path">
                        </div>

                    </div>
                    <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                </div>
                <div class="etc-login-form">
                    <button id="square_btn" onClick="history.back()">戻る</button>
                </div>
            </form>
        </div>
        <!-- end:Main Form -->
    </div>

@endsection
