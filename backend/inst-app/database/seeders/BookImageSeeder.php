<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\BookImage;

class BookImageSeeder extends Seeder
{
    public function run(): void
    {
        // Vymaž existujúce záznamy aby sa nepridávali duplicity
        BookImage::truncate();

        // Najprv pridaj fotky z photo1 a photo2 pre všetky knihy
        Book::all()->each(function ($book) {
            if ($book->photo1) {
                BookImage::create([
                    'book_id'  => $book->book_id,
                    'filename' => $book->photo1,
                    'order'    => 1,
                ]);
            }
            if ($book->photo2) {
                BookImage::create([
                    'book_id'  => $book->book_id,
                    'filename' => $book->photo2,
                    'order'    => 2,
                ]);
            }
        });

        // Pridaj extra fotky pre konkrétne knihy
        $mate = Book::where('name', 'Mate')->first();
        if ($mate) {
            BookImage::create([
                'book_id'  => $mate->book_id,
                'filename' => 'mate_backside.jpeg',
                'order'    => 2,
            ]);
        }
    }
}
