@extends('template')

@section('title','ユーザー新規登録')
@section('description','ユーザー登録のページ')
@include('head')

@section('content')

<!-- REGISTRATION FORM -->
<div class="text-center" style="padding:50px 0">
	<div class="logo">新規登録</div>
	<!-- Main Form -->
	<div class="login-form-1">
		<form action="#" method="POST" id="register-form" class="text-left">
			@csrf
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					
					{{-- 名前 --}}
					<div class="form-group">
						<label for="name" class="sr-only">name</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="name">
					</div>

					{{-- メールアドレス --}}
					<div class="form-group">
						<label for="reg_email" class="sr-only">Email</label>
						<input type="text" class="form-control" id="reg_email" name="reg_email" placeholder="email">
					</div>

					{{-- パスワード --}}
					<div class="form-group">
						<label for="reg_password" class="sr-only">Password</label>
						<input type="password" class="form-control" id="reg_password" name="reg_password" placeholder="password">
					</div>
					{{-- パス確認 --}}
					<div class="form-group">
						<label for="reg_password_confirm" class="sr-only">Password Confirm</label>
						<input type="password" class="form-control" id="reg_password_confirm" name="reg_password_confirm" placeholder="confirm password">
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