<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

//    public function Products()
//    {
//        return $this->belongsToMany(Product::class, 'product_tags');
//    }

    public function Products()
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }

    public function pages()
    {
        return $this->morphedByMany(Page::class, 'taggable');
    }

}
