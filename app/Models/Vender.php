<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//ログイン時に使う
class Vender extends Model
{
    // use HasFactory;
    protected $fillable = [
        'email',
        'password'
        ];
}
