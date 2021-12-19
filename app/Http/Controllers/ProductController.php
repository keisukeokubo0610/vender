<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductFormRequest;
use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\ProductDeleteRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Update;
use Illuminate\Support\Str;


use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{

    /*****    商品新規登録画面表示    *****/
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

        return view('product/productAdd', ['products' => $products]);
    }

    /*****    商品新規登録    *****/
    public function productAdd(ProductAddRequest $request)
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

        return redirect(Route('showProductAdd'))->with('success', '商品登録に成功しました！');
    }





    /*****    商品編集画面表示    *****/
    public function showUpdate()
    {
        $products = Search::select([
            'product.id',
            'product.img_path',
            'product.company_id',
            'product.product_name',
            'product.price',
            'product.stock',
            'product.comment',
            'company.company_name',
        ])
            ->from('products as product')
            ->join('companies as company', function ($join) {
                $join->on('product.company_id', '=', 'company.id');
            })
            ->first();

        if (is_null($products)) {

            return redirect(route('searchProductlist'))->with('err_msg', 'データがありません');
        }

        return view('product.update', compact('products'));
    }


    /*****    商品編集実行    *****/
    public function productUpdate(ProductUpdateRequest $request)
    {
        // $items = Update::find($request->id)->get();

        $inputs = $request->all();


        DB::beginTransaction();
        try {
            //商品編集
            $product = Search::find($inputs['id']);
            $product->fill([

                'img_path' => $inputs['img_path'],
                'product_name' => $inputs['product_name'],
                'price' => $inputs['price'],
                'stock' => $inputs['stock'],
                'comment' => $inputs['comment'],
                'company_name' => $inputs['company_name'],
            ]);
            $product->save();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            abort(500);
        }

        return view('searchDetail', compact('product'));

        //homeルートにリダイレクトする
        return redirect(route('showUpdate'))->with('success', '商品が更新されました！');
    }



    /*****    商品削除    *****/
    public function productDelete($id)
    {

        // dd(Search::find($id));
        $searchId = Search::find($id);

        if (empty($id)) {
            //homeルートにリダイレクトする
            return redirect(route('searchProductlist'))->with('danger', 'データがありません');
        }

        try {
            //商品削除
            $searchId->delete();
        } catch (\Throwable $e) {
            abort(500);
        }

        //homeルートにリダイレクトする
        return redirect(route('searchProductlist'))->with('success', '商品が削除されました！');
    }
}
