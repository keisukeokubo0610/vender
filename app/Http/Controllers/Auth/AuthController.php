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

            //homeルータにリダイレクトする
            return redirect('/home')->with('login_success', 'ログインに成功しました！');
        }

        //失敗した場合
        //もとの画面に戻る
        return back()->withErrors([
            'login_error' => 'メールアドレスかパスワードが間違っています。',
        ]);

        // dd($request->all());
    }
}
