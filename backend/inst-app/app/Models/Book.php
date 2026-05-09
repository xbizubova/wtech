<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name', 'author', 'price', 'detail',
        'language', 'rating', 'amount', 'release_date',
        'is_booktok', 'is_recommended', 'is_hidden'
    ];
    protected $primaryKey = 'book_id';

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

    public function images()
    {
        return $this->hasMany(BookImage::class, 'book_id')->orderBy('order');
    }

    public function sale()
    {
        return $this->hasOne(BookSale::class, 'book_id');
    }

    public function getIsOnSaleAttribute(): bool
    {
        if (!$this->sale) return false;
        $today = now()->toDateString();
        $start = $this->sale->start_sale;
        $end = $this->sale->end_sale;

        if ($start && $today < $start) return false;
        if ($end && $today > $end) return false;

        return $this->sale->price_modifier !== null;
    }

    public function getFinalPriceAttribute()
    {
        if ($this->is_on_sale && $this->sale?->price_modifier) {
            return round($this->price * $this->sale->price_modifier, 2);
        }
        return $this->price;
    }
}
