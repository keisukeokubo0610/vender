<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable; //追記
use App\Models\Company;
use App\Models\Sale;

//商品検索時に使う
class Search extends Model
{
    use Sortable; //追記

    protected $table = 'products';
    protected $fillable = [
        // id
        'id',
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
        'company_id',

    ];

    public $sortableAs = [
        'products.id',
        'products.price',
        'products.stock',
    ]; //追記(ソートに使うカラムを指定


    public function products()
    {
        return $this->hasMany(Company::class);
    }

    public function Sales()
    {
        return $this->belongsTo(Sale::class);
    }


}
