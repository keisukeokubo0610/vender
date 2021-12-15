<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Create;
use App\Models\Search;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //商品新規登録画面表示
    public function showProductAdd()
    {
        return view('product/productAdd');
    }



    // 商品登録
    public function productAdd(ProductFormRequest $request)
    {


        $credentials = $request->all();

        if (isset($credentials['img_path'])) {
            // $fileにイメージデータを格納する
            $file = $request->file('img_path');
            // getClientOrientalExtension()でファイルの拡張子を取得する
            $extension = $file->getClientOriginalExtension();
            $file_token = Str::random(10);
            $filename = $file_token . '.' . $extension;
            // 表示を行うときに画像名が必要になるため、ファイル名を再設定
            $form['img_path'] = $filename;
            $file->move('storage', $filename);
        }

        DB::beginTransaction();

        try {
            //商品登録
            Create::create($credentials);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            abort(500);
        }

        // session()->flash('success', '商品登録が完了しました。');
        return redirect('product/productAdd')->with('success', '商品登録に成功しました！');
    }


}
