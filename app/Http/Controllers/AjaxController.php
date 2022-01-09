<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{

    // 商品一覧表示
    public function getProductAjax()
    {
       
        // $products = $this->product->where('name', 'like', '%' . $productsName . '%')->orderBy('items_count', 'desc')->get(); //出品数もほしいため、withCountでitemテーブルのレコード数も取得
        $products = Search::select([
            'product.id',
            'product.img_path',
            'product.product_name',
            'product.price',
            'product.stock',
            'company.company_name',
        ])
            ->from('products as product')
            ->join('companies as company', function ($join) {
                $join->on('product.company_id', '=', 'company.id');
            })
            // ->sortable('item_sort')
            ->orderBy('product.id', 'desc')
            ->get();

        $json = ['products' => $products];

        return response()->json($json);
    }



    /*****    キーワード検索    *****/
    public function getNameSearch(Request $request)
    {

         //入力された文字
         $search_name = $request->get('search_name');
        //  $makers = Company::all();

        //あいまい検索
        if ($search_name !== null) {
            $escape_word = addcslashes($search_name, '\\_%');
            $products = Search::where('product_name', 'like', '%' . $escape_word . '%')->get();
        } else {
            $products = Search::all();
        }
        $json = ['products' => $products];
        return response()->json($json);
        // return view('home', compact('products', 'makers'));
    }
}
