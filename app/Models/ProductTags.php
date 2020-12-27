<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTags extends Model
{
    //product_tags

    use HasFactory;

    protected $fillable = [
        'product_id', 'tag_id'
    ];
}



