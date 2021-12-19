<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    protected $table = 'products';
    protected $fillable = [
        // id
        // 'id',
        // 商品画像
        'img_path',
        // 商品名
        'product_name',
        // 価格
        'price',
        // 在庫数
        'stock',
        //コメント
        'comment',        
        // メーカー名
        'company_name',

        ];
}
