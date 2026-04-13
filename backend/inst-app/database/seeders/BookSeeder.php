<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Kategórie
        $fantasy   = Category::create(['type' => 'Fantasy']);
        $comics    = Category::create(['type' => 'Comics']);
        $manga     = Category::create(['type' => 'Manga']);
        $poetry    = Category::create(['type' => 'Poetry']);
        $forkids   = Category::create(['type' => 'For kids']);
        $encyclo   = Category::create(['type' => 'Encyclopedia']);
        $cooking   = Category::create(['type' => 'Cooking']);
        $romance   = Category::create(['type' => 'Romance']);
        $detective = Category::create(['type' => 'Detectives']);

        // Knihy
        $books = [
            [
                'name' => 'Mate',
                'author' => 'Ali Hazelwood',
                'price' => 15.99,
                'language' => 'EN',
                'rating' => 4,
                'amount' => 10,
                'release_date' => '2024-01-01',
                'is_on_sale' => false,
                'categories' => [$romance->category_id],
            ],
            [
                'name' => 'Looking for Alaska',
                'author' => 'John Green',
                'price' => 12.99,
                'language' => 'EN',
                'rating' => 5,
                'amount' => 8,
                'release_date' => '2005-03-03',
                'is_on_sale' => false,
                'categories' => [$romance->category_id],
            ],
            [
                'name' => 'Problematic Summer Romance',
                'author' => 'Ali Hazelwood',
                'price' => 10.99,
                'language' => 'EN',
                'rating' => 4,
                'amount' => 6,
                'release_date' => '2023-06-01',
                'is_on_sale' => true,
                'categories' => [$romance->category_id],
            ],
            [
                'name' => 'Attack on Titan vol.1',
                'author' => 'Hajime Isayama',
                'price' => 10.00,
                'language' => 'EN',
                'rating' => 5,
                'amount' => 15,
                'release_date' => '2009-09-09',
                'is_on_sale' => false,
                'categories' => [$manga->category_id],
            ],
            [
                'name' => 'Attack on Titan vol.2',
                'author' => 'Hajime Isayama',
                'price' => 10.00,
                'language' => 'EN',
                'rating' => 5,
                'amount' => 15,
                'release_date' => '2009-12-09',
                'is_on_sale' => false,
                'categories' => [$manga->category_id],
            ],
            [
                'name' => 'Attack on Titan vol.3',
                'author' => 'Hajime Isayama',
                'price' => 10.00,
                'language' => 'EN',
                'rating' => 5,
                'amount' => 15,
                'release_date' => '2010-03-09',
                'is_on_sale' => false,
                'categories' => [$manga->category_id],
            ],
        ];

        foreach ($books as $bookData) {
            $categories = $bookData['categories'];
            unset($bookData['categories']);
            $book = Book::create($bookData);
            $book->categories()->attach($categories);
        }
    }
}
