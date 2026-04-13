<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'category_id';
    protected $fillable = ['type'];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_category', 'category_id', 'book_id');
    }
}
