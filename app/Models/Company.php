<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Search;

//
class Company extends Model
{
    protected $companyTable = 'companies';
    protected $fillable = [
        'id',
        'company_name',
    ];
    public function search()
    {
        // return $this->hasOne(Search::class);
        return $this->belongsTo(Search::class);
    }
}
