<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $primaryKey = 'basket_id';

    protected $fillable = ['customer_id'];

    // Basket patrí userovi
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Basket má veľa kníh cez pivot tabuľku book_basket
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_basket', 'basket_id', 'book_id')
            ->withPivot('amount')
            ->withTimestamps();
    }
}

