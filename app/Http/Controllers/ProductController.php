<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Create;
use App\Models\Search;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductFormRequest;
use App\Http\Requests\ProductAddRequest;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //商品新規登録画面表示
    public function showProductAdd()
    {


        $products = Search::select([
            'product.id',
            'product.img_path',
            'product.company_id',
            'product.product_name',
            'product.price',
            'product.stock',
            'company.company_name',
        ])
            ->from('products as product')
            ->join('companies as company', function ($join) {
                $join->on('product.company_id', '=', 'company.id');
            })
            ->get();


        return view('product/productAdd',['products' => $products]);
    }



    // 商品登録
    public function productAdd(ProductAddRequest $request)
    {


        // $credentials = Search::all();

        $credentials = $request->all();

        // $id = $request->only('product_id');

        // $credentials = Search::select([
        //     'product.comment',
        //     // 'product.company_id',
        //     'product.img_path',
        //     'product.product_name',
        //     'product.price',
        //     'product.stock',
        //     'company.company_name',
        // ])
        //     ->from('products as product')
        //     ->join('companies as company', function ($join) {
        //         $join->on('product.company_id', '=', 'company.id');
        //     })
        //     ->get();


        if (isset($credentials['img_path'])) {
            // $fileにイメージデータを格納する
            $file = $request->file('img_path');
            // getClientOrientalExtension()でファイルの拡張子を取得する
            $extension = $file->getClientOriginalExtension();
            $file_token = Str::random(10);
            $filename = $file_token . '.' . $extension;
            // 表示を行うときに画像名が必要になるため、ファイル名を再設定
            $credentials['img_path'] = $filename;
            $file->move('storage', $filename);
        }


        DB::beginTransaction();

        try {
            //商品登録
            Search::create($credentials);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            abort(500);
        }

        // session()->flash('success', '商品登録が完了しました。');
        return redirect(Route('showProductAdd'))->with('success', '商品登録に成功しました！');
    }


}
