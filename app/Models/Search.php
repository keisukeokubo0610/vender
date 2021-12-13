<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//商品検索時に使う
class Search extends Model
{
    protected $table = 'products';
    protected $fillable = [
        // id
        // 商品画像
        // 商品名
        // 価格
        // 在庫数
        // メーカー名
        'id',
        'product_name',
        'price',
        'stock',
        'company_id',

        ];
}