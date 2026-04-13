<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $primaryKey = 'book_id';
    protected $fillable = [
        'name', 'author', 'price', 'original_price', 'detail',
        'language', 'rating', 'photo1', 'photo2',
        'amount', 'release_date', 'is_on_sale',
        'is_booktok', 'is_recommended'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category', 'book_id', 'category_id');
    }

    public function baskets()
    {
        return $this->belongsToMany(Basket::class, 'book_basket', 'book_id', 'basket_id')
            ->withPivot('amount')
            ->withTimestamps();
    }
}
