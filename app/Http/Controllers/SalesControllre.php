<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Search;
use Illuminate\Support\Facades\DB;

class SalesControllre extends Controller
{

    // 購入処理
    public function stockAPI(Request $request)
    {

        $inputs = $request->all();

        $id = $request->get('id');
        $product_stock = $request->get('product_stock');

        DB::beginTransaction();

        if ($product_stock >= 0) {


            $result = DB::table('sales')
                ->join('products', function ($join) {
                    $join->on('sales.product_id', '=', 'products.id');
                })
                ->where('sales.product_id', '=', $id)
                // ->orWhere(function ($query) {
                //     $query->where('products.id');
                // })
                ->decrement('products.stock');

            try {
                // $products->update();
                //DBに結果を保存
                DB::commit();
            } catch (\Exception $e) {
                $result = [
                    'result' => false,
                    'error' => [
                        'messages' => [$e->getMessage()]
                    ],
                ];
                return $this->resConversionJson($result, $e->getCode());
            }
            return $this->resConversionJson($result);
        } else {
            return redirect(route('searchProductlist'))->with('danger', '在庫がありません');
        }
    }

    private function resConversionJson($result, $statusCode = 200)
    {
        if (empty($statusCode) || $statusCode < 100 || $statusCode >= 600) {
            $statusCode = 500;
        }
        return response()->json($result, $statusCode, ['Content-Type' => 'application/json'], JSON_UNESCAPED_SLASHES);
    }
}
