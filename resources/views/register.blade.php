@extends('template')

@section('title', 'ユーザー新規登録')
@section('description', 'ユーザー登録のページ')
    @include('head')

@section('content')

    <!-- REGISTRATION FORM -->
    <div class="text-center" style="padding:50px 0">
        <div class="logo">新規登録</div>
        <!-- Main Form -->
        <div class="login-form-1">
            <form method="POST" action="{{ route('userAdd') }}" id="register-form" class="text-left">
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

                        {{-- 名前 --}}
                        <div class="form-group">
                            <label for="name" class="sr-only">name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="name">
                        </div>

                        {{-- メールアドレス --}}
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="email">
                        </div>

                        {{-- パスワード --}}
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="password">
                        </div>
                        {{-- パス確認 --}}
                        <div class="form-group">
                            <label for="password_confirmation" class="sr-only">Password Confirm</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="password confirm">
                        </div>

                    </div>
                    <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                </div>
                <div class="etc-login-form">
                    <p>すでに登録済みの方はこちら <a href="{{ route('showLogin') }}">login here</a></p>
                </div>
            </form>
        </div>
        <!-- end:Main Form -->
    </div>

@endsection
