<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookImage extends Model
{
    protected $primaryKey = 'image_id';
    protected $fillable = ['book_id', 'filename', 'order'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
