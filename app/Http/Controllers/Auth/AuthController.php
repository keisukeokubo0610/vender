<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    //@return View
    public function showLogin()
    {
        return view('login.login_form');
    }

    /*
    @param App\Http\Requests\LoginFormRequest;
    $request
    */
    public function login(LoginFormRequest $request)
    {

        $credentials = $request->only('email', 'password');


        //成功した場合
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            //homeルートにリダイレクトする
            return redirect('home')->with('success', 'ログインに成功しました！');
        }

        //失敗した場合
        //もとの画面に戻る
        return back()->withErrors([
            'danger' => 'メールアドレスかパスワードが間違っています。',
        ]);

        // dd($request->all());
    }

    public function register() {
        return view('register');
    }

    /**
     * ユーザーをアプリケーションからログアウトさせる
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with
        ('danger','ログアウトしました！');
    }



}
