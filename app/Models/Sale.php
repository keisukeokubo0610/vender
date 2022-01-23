<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Search;

class Sale extends Model
{
    // use HasFactory;
    protected $table = 'sales';
    // protected $dates =  ['created_at', 'updated_at'];
    protected $fillable = [
        'id',
        'product_id',
        'product_stock',
    ];

    public function products()
    {
        return $this->hasMany(Search::class);
    }


}
