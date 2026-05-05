<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $books = DB::table('books')->get();

        foreach ($books as $book) {
            if ($book->photo1) {
                DB::table('book_images')->insert([
                    'book_id'    => $book->book_id,
                    'filename'   => $book->photo1,
                    'order'      => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            if ($book->photo2) {
                DB::table('book_images')->insert([
                    'book_id'    => $book->book_id,
                    'filename'   => $book->photo2,
                    'order'      => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        DB::table('book_images')->truncate();
    }
};
