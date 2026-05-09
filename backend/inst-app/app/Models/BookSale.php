<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookSale extends Model
{
    protected $fillable = ['book_id', 'price_modifier', 'start_sale', 'end_sale'];

    public function sale()
    {
        return $this->hasOne(BookSale::class, 'book_id');
    }

// vypočíta finálnu cenu ak je zľava aktívna
    public function getFinalPriceAttribute()
    {
        if ($this->is_on_sale && $this->sale && $this->sale->price_modifier) {
            return round($this->price * $this->sale->price_modifier, 2);
        }
        return $this->price;
    }
}
