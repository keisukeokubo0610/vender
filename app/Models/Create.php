<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Create extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        ];
}
