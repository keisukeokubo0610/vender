<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Create;
use Illuminate\Support\Facades\DB;


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

    //ユーザー新規登録画面に行く
    public function showRegister()
    {
        return view('register');
    }


    // ユーザー登録
    public function userCreate(RegisterUserRequest $request)
    {


        //ユーザーのデータ受け取る
        $inputs = $request->all();

        DB::beginTransaction();

        try {
            //ユーザー登録
            Create::create($inputs);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            abort(500);
        }



        session()->flash('success', 'ユーザー登録が完了しました。');
        return redirect(route('showLogin'));
    }


    /**
     * ユーザーをアプリケーションからログアウトさせる
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
