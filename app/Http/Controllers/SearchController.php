<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search;


//商品一覧をする
class SearchController extends Controller
{
    public function searchProductlist()
    {
        // $products = Search::all();

        //    SELECT * FROM companies INNER JOIN products ON companies.id = products.company_id;

        $results = Search::select([
            'product.id',
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


        return view('/home', ['results'=>$results]);
    }
}
