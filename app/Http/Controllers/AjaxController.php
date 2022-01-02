<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search;
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
}
