<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//
class Company extends Model
{
    protected $companyTable = 'companies';
    protected $fillable = [
        'id',
        'company_name',
    ];
}
