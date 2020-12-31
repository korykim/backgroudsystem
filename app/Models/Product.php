<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'detail'
    ];

//    public function tags()
//    {
//        return $this->belongsToMany(Tag::class, 'product_tags')->as('taggable')->withTimestamps();
//    }
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


}
