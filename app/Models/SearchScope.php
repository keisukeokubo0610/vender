<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchScope extends Model
{
/**
 * 絞り込み・キーワード検索
 * @param \Illuminate\Database\Eloquent\Builder
 * @param array
 * @return \Illuminate\Database\Eloquent\Builder
 */
// public function scopeSerach(Search $query, array $params): Search
// {

// dd($query->all());

//     // 性別絞り込み
//     if (!empty($params['company_name'])) $query->where('company_name', $params['company_name']);

//     // キーワード検索
//     if (!empty($params['keyword'])) {
//         $query->where(function ($query) use ($params) {
//             $query->where('sei', 'like', '%' . $params['keyword'] . '%')
//                 ->orWhere('mei', 'like', '%' . $params['keyword'] . '%')
//                 ->orWhere('family_name', 'like', '%' . $params['keyword'] . '%')
//                 ->orWhere('last_name', 'like', '%' . $params['keyword'] . '%');
//         });
//     }

//     return $query;
// }

}
