<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable; //追記
use App\Models\Company;

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

    public $sortable = [
        'id',
        'price',
        'stock',
    ]; //追記(ソートに使うカラムを指定


    public function products()
    {
        return $this->hasOne(Company::class);
    }


    // public $sortableAs = ['item_sort'];

    // public function itemSortable($query, $direction)
    // {
    //     return $query->join('companies as company', function ($join) {
    //         $join->on('products.company_id', '=', 'company.id');
    //     })
    //     ->orderBy('products.id', $direction);
    // }
}
