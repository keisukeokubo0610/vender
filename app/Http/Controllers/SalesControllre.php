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

        $result = DB::table('sales')
        ->join('products', function ($join) {
            $join->on('sales.product_id', '=', 'products.id');
        })
        ->where('sales.product_id','=', $id)
        ->decrement('sales.product_stock','products.stock');
        
        try {
            // $products->update();
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
    }

    private function resConversionJson($result, $statusCode = 200)
    {
        if (empty($statusCode) || $statusCode < 100 || $statusCode >= 600) {
            $statusCode = 500;
        }
        return response()->json($result, $statusCode, ['Content-Type' => 'application/json'], JSON_UNESCAPED_SLASHES);
    }
}
