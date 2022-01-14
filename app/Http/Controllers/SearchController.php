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
    public function searchProductlist(Request $request)
    {

        $products = Search::select([
            'products.id',
            'products.img_path',
            'products.product_name',
            'products.price',
            'products.stock',
            'company.company_name',
        ])
            ->from('products')
            ->join('companies as company', function ($join) {
                $join->on('products.company_id', '=', 'company.id');
            })
            ->sortable()
            ->orderBy('products.id', 'desc')
            ->get();

        $makers = Company::all();

        return view('/home', compact('products', 'makers'));
    }

    //ソート機能
    // public function index(Request $request)
    // {
      
    //         $products = Search::select([
    //             'products.id',
    //             'products.img_path',
    //             'products.product_name',
    //             'products.price',
    //             'products.stock',
    //             'companies.company_name',
    //             ])
    //             ->from('products')
    //             ->join('companies','products.company_id', '=', 'companies.id')
    //             ->sortable()
    //             ->orderBy('products.id', 'desc')
    //             ->get();
                
    //             $makers = Company::all();
    //             return view('/home', compact('products', 'makers'));
    //         }
            



    /*****    商品詳細表示    *****/
    public function showDetail($id)
    {

        // $makers = Company::all();
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
            ->join('companies as company', function ($join) {
                $join->on('product.company_id', '=', 'company.id');
            })
            ->where('product.id', $id)
            ->get();


        if (is_null($product)) {

            return redirect(route('searchProductlist'))->with('danger', 'データがありません');
        }

        return view('searchDetail', compact('results', 'product'));
    }

    // /*****    キーワード検索    *****/  
    // public function productSearch(Request $request)
    // {
    //     //入力された文字
    //     $products = Search::all();
    //     $search_name = $request->get('search_name');
    //     $makers = Company::all();

    //     return view('home', compact('products','search_name', 'makers'));
    // }




    // public function productSearch(Request $request)
    // {
    //     //入力された文字
    //     $word = $request->get('word');
    //     $makers = Company::all();


    //     //あいまい検索
    //     if ($word !== null) {
    //         $escape_word = addcslashes($word, '\\_%');
    //         $products = Search::where('product_name', 'like', '%' . $escape_word . '%')->get();
    //     } else {
    //         $products = Search::all();
    //     }
    //     return view('home', compact('products', 'makers'));
    // }


    /*****    メーカー検索    *****/
    // public function companySearch(Request $request)
    // {

    //     $makers = Company::all();
    //     $company = $request->get('company_name');

    //     if (is_null($company)) {
    //         $products = Search::all();
    //         return redirect(route('searchProductlist'))->with('danger', 'データがありません');
    //     }

    //     $products = Search::select([
    //         'product.id',
    //         'product.img_path',
    //         'product.product_name',
    //         'product.price',
    //         'product.stock',
    //         'company.company_name',
    //     ])
    //         ->from('products as product')
    //         ->join('companies as company', function ($join) {
    //             $join->on('product.company_id', '=', 'company.id');
    //         })
    //         ->where('company_name', $company)
    //         ->get();


    //     return view('home', compact('products', 'makers'));
    // }


    /*****    価格検索    *****/
    // public function priceSearch(Request $request)
    // {
    //     $makers = Company::all();
    //     $price = $request->get('price');

    //     if (is_null($price)) {
    //         $products = Search::all();
    //         return redirect(route('searchProductlist'))->with('danger', 'データがありません');
    //     }

    //     $products = Search::select([
    //         'product.id',
    //         'product.img_path',
    //         'product.product_name',
    //         'product.price',
    //         'product.stock',
    //         'company.company_name',
    //     ])
    //         ->from('products as product')
    //         ->join('companies as company', function ($join) {
    //             $join->on('product.company_id', '=', 'company.id');
    //         })
    //         ->where('price', $price)
    //         ->get();


    //     return view('home', compact('products', 'makers'));
    // }




    /*****    ストック検索    *****/
    // public function stockSearch(Request $request)
    // {

    //     $makers = Company::all();
    //     $stock = $request->get('stock');

    //     if (is_null($stock)) {
    //         $products = Search::all();
    //         return redirect(route('searchProductlist'))->with('danger', 'データがありません');
    //     }

    //     $products = Search::select([
    //         'product.id',
    //         'product.img_path',
    //         'product.product_name',
    //         'product.price',
    //         'product.stock',
    //         'company.company_name',
    //     ])
    //         ->from('products as product')
    //         ->join('companies as company', function ($join) {
    //             $join->on('product.company_id', '=', 'company.id');
    //         })
    //         ->where('stock', $stock)
    //         ->get();


    //     return view('home', compact('products', 'makers'));
    // }



}
