<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{

    //ソート
    // public function index($id = null, $stock = null, $price = null, $sort_item =  null, $sort = null)
    public function index(Request $request)
    {
        $sort_item = $request->get('sort_item');
        $sort = $request->get('sort');

        // ソート
        if (!is_null($sort_item) && !is_null($sort)) {
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
                })->orderBy($sort_item, $sort);
           
            return $products->get();
        }

    }



    // 商品一覧表示
    public function getProductAjax()
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
            // ->sortable()
            // ->orderBy('product.id', 'desc')
            ->latest('product.id')
            ->get();

        $json = ['products' => $products];

        return response()->json($json);
    }



    /*****    キーワード検索    *****/
    public function getNameSearch(Request $request)
    {

        //入力された文字
        $search_name = $request->get('search_name');
        //  $makers = Company::get('company_name');

        //あいまい検索
        if ($search_name !== null) {

            $escape_word = addcslashes($search_name, '\\_%');
            $products = DB::table('products as product')
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
                ->where('product_name', 'like', '%' . $escape_word . '%')
                ->get();
        } else {
            $products = Search::all();
        }
        $json = ['products' => $products];
        return response()->json($json);
    }









    /*****    メーカー検索    *****/
    public function companySearch(Request $request)
    {
        // $makers = Company::find('company_name');
        $companyName = $request->get('search_company_name');


        if ($companyName !== null) {
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
                ->where('company_name', '=', $companyName)
                ->get();
        } else {
            $products = Search::all();
        }
        $json = ['products' => $products];
        return response()->json($json);

        // return view('home', compact('products', 'makers'));
    }


    /*****    価格検索    *****/
    public function priceSearch(Request $request)
    {

        $search_price = $request->get('search_price');

        if ($search_price !== null) {

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
                ->where('price', '=', $search_price)
                ->get();
            // return redirect(route('searchProductlist'))->with('danger', 'データがありません');
        } else {
            $products = Search::all();
        }
        $json = ['products' => $products];
        return response()->json($json);
        //  return view('home', compact('products', 'makers'));
    }


    /*****    ストック検索    *****/
    public function stockSearch(Request $request)
    {

        $search_stock = $request->get('search_stock');

        if ($search_stock !== null) {

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
                ->where('stock', $search_stock)
                ->get();
            // return redirect(route('searchProductlist'))->with('danger', 'データがありません');
        } else {
            $products = Search::all();
        }
        $json = ['products' => $products];
        return response()->json($json);
        //  return view('home', compact('products', 'makers'));
    }
}
