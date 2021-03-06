@extends('template')

@section('title', 'ログイン画面')
@section('description', 'ユーザーログインのページ')
    @include('head')

@section('content')

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
                    {{-- <x-alert type="success" :session="session('success')" /> --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif


                    {{-- 警告文 --}}
                    <x-alert type="danger" :session="session('danger')" />


                    <div class="login-group">
                        <div class="form-group">
                            <label for="email" class="sr-only">email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="email">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="password">
                        </div>

                    </div>
                    <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                </div>
                <div class="etc-login-form">
                    <a class="btn btn-success" href="{{ route('showRegister') }}">ユーザー新規登録</a>
                </div>
            </form>
        </div>
        <!-- end:Main Form -->
    </div>

@endsection
