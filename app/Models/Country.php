<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug'
    ];


    public function Products()
    {
        //第一个参数是关联的模型类，第二个参数是中间借助的模型类

        return $this->hasManyThrough(Product::class, User::class);
    }
}
