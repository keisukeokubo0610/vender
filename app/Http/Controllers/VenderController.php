<?php

namespace App\Http\Controllers;

use App\Models\Vender;
use App\Http\Requests\VenderRequest;


class VenderController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function success(VenderRequest $request)
    {
        $validated = $request->validate([
            'email' => 'required' ,
            'password' => 'required|regex:regex:/^[a-zA-Z0-9-]+$/|' ,
        ],
        [
            'email.required' => 'メールアドレスを入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.regex:regex:/^[a-zA-Z0-9-]+$/' => '半角英数字で入力してください',
        ]);


        $vender = new Vender();

        
        $email = $request->email;
        $password = $request->password;


        //DBに保存
        $email->save();
        $password->save();

        //リダイレクト
        return redirect(route('/success'))->with('success', 'ログイン完了');
        }
}


