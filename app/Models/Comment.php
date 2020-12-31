<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content', 'user_id'
    ];

    // 要触发更新的父级关联关系
//    protected $touches = [
//        'commentable'
//    ];

    //protected $guarded = [];

    public function Products()
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }
}
