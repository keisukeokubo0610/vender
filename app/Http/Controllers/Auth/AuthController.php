<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Create;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{


    /*****    ログイン画面表示    *****/
    public function showLogin()
    {
        return view('login.login_form');
    }

    /*****    ログイン処理    *****/
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

    }



    /*****    ユーザー新規登録画面    *****/
    public function showRegister()
    {
        return view('register');
    }


    /*****    ユーザー新規登録実行    *****/
    public function userAdd(RegisterUserRequest $request)
    {

        try {
        Create::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->save();
        DB::commit();

        } catch (\Throwable $e) {
            DB::rollback();
            abort(500);
        }

        session()->flash('success', 'ユーザー登録が完了しました。');
        return redirect(route('showLogin'));
    }



    /**
     * ログアウト処理
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('danger', 'ログアウトしました！');
    }
}
