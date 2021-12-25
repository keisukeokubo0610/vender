@extends('template')

@section('title', '商品編集')
@section('description', '商品編集のページ')
    @include('head')

@section('content')




    <!-- REGISTRATION FORM -->
    <div class="text-center" style="padding:50px 0">


        {{-- アラート表示 --}}
        <x-alert type="success" :session="session('success')" />


        <div class="logo">商品編集</div>
        <!-- Main Form -->




        <div class="login-form-1">
            {{-- <form method="POST" action="{{ route('userUpdate') }}" id="register-form" class="text-left"> --}}
            <form method="POST" action="{{ route('productUpdate',$products->id) }}" id="register-form" class="text-left">
                @csrf
                <div class="login-form-main-message"></div>
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


                        {{-- @foreach ($products as $product) --}}
                        {{-- 商品ID --}}
                        <div class="form-group">
                            <input value="{{ $products->id }}" type="hidden" class="form-control" name="id">
                        </div>

                        {{-- 商品名 --}}
                        <div class="form-group">
                            <label for="product_name" class="sr-only">商品名</label>
                            <input value="{{ $products->product_name }}" type="text" class="form-control" id="product_name" name="product_name">
                        </div>

                        {{-- メーカー --}}
                        <div class="form-group">
                            <label for="company_id" class="sr-only">メーカー名</label>
                            <select name="company_id" id="company_id" >
                                {{-- <option name="" selected>選択してください</option> --}}
                                @foreach ($makers as $maker)
                                    <option value="{{ $maker->id }}">{{ $maker->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- 価格 --}}
                        <div class="form-group">
                            <label for="price" class="sr-only">価格</label>
                            <input value="{{ $products->price }}" type="text" class="form-control" id="price"
                                name="price" >
                        </div>
                        {{-- 在庫 --}}
                        <div class="form-group">
                            <label for="stock" class="sr-only">在庫</label>
                            <input value="{{ $products->stock }}" type="text" class="form-control" id="stock" name="stock"
                                placeholder="stock">
                        </div>
                        {{-- コメント --}}
                        <div class="form-group">
                            <label for="comment" class="sr-only">コメント</label>
                            <input value="{{ $products->comment }}" type="text" class="form-control" id="comment"
                                name="comment" placeholder="">
                        </div>
                        {{-- 画像 --}}
                        <div class="form-group">
                            <label for="img_path" class="sr-only">画像</label>
                            <input value="{{ $products->img_path }}" type="text" class="form-control" id="img_path" name="img_path"
                            >
                        </div>
                      {{-- @endforeach --}}

                    </div>
                    <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                </div>
                
                <div class="etc-login-form">

                    <a class="btn btn-success" href="{{ Route('searchProductlist') }}">戻る</a>
                </div>
            </form>
        </div>
        <!-- end:Main Form -->
    </div>

@endsection
