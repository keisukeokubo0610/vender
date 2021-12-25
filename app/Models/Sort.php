<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable; //追記

class Sort extends Model
{
    use Sortable; //追記

    public $sortable = ['product.id', 'product.price', 'product.stock']; //追記(ソートに使うカラムを指定

    public function productsType()
    {
        return $this->hasOne(Search::class);
    }
}
