<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search;
use App\Models\Company;
use Config\Session;
use Illuminate\Support\Facades\DB;

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
            
            $makers = Company::all();

        return view('/home', compact('products', 'makers'));
    }


    /*****    商品詳細表示    *****/
    public function showDetail($id)
    {

        $makers = Company::all();
        $product = Search::find($id);

        $results = DB::table('products as product')
        ->select([
            'product.id',
            'product.img_path',
            'product.product_name',
            'product.price',
            'product.stock',
            'company.company_name',
            ])
            // ->from('products as product')
            ->join('companies as company', function ($join) {
                $join->on('product.company_id', '=', 'company.id');
            })
            ->get();

        
        if (is_null($product)) {
            
            return redirect(route('searchProductlist'))->with('danger', 'データがありません');
        }
        
        return view('searchDetail', compact('results','makers','product'));
    }


    // キーワード検索
    public function productSearch(Request $request)
    {
        $makers = Company::all();
        $word = $request->get('word');
        if ($word !== null) {
            $escape_word = addcslashes($word, '\\_%');
            $products = Search::where('product_name', 'like', '%' . $escape_word . '%')->get();
        } else {
            $products = Search::all();
        }
        return view('home', compact('products', 'makers'));
    }

    // 会社検索
    public function companySearch(Request $request)
    {

        $makers = Company::all();
        $company = $request->get('company_name');
        
        if (is_null($company)) {
            $products = Search::all();
            return redirect(route('searchProductlist'))->with('danger', 'データがありません');
        }
        
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
            ->where('company_name',$company)
            ->get();

        
        return view('home', compact('products', 'makers'));
    }
}
