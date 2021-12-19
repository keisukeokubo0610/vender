<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search;
use Config\Session;

class SearchController extends Controller
{

    /*****    商品一覧表示    *****/
    public function searchProductlist()
    {
      
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
            ->get();


        return view('/home', ['products' => $products]);
    }


    /*****    商品詳細表示    *****/
    public function showDetail($id)
    {
        $product = Search::find($id);

        if (is_null($product)) {

            return redirect(route('searchProductlist'))->with('err_msg', 'データがありません');
        }

        return view('searchDetail', ['product' => $product]);

    }
}
