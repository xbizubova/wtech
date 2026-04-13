<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use function Symfony\Component\String\b;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Kategórie
        $fantasy = Category::create(['type' => 'Fantasy']);
        $manga = Category::create(['type' => 'Manga']);
        $forkids = Category::create(['type' => 'For kids']);
        $cooking = Category::create(['type' => 'Cooking']);
        $romance = Category::create(['type' => 'Romance']);
        $ya = Category::create(['type' => 'Young Adult']);
        $detective= Category::create(['type' => 'Detective']);
        $thriller = Category::create(['type' => 'Thriller']);
        $historical= Category::create(['type' => 'Historical']);
        $encyclo = Category::create(['type' => 'Encyclopedia']);

        $books = [
            // Romance
            ['name' => 'Mate', 'author' => 'Ali Hazelwood', 'price' => 15.99, 'language' => 'EN', 'rating' => 4, 'amount' => 10, 'release_date' => '2024-01-01', 'is_on_sale' => false, 'photo1' => 'mate.JPG','is_booktok' => true, 'categories' => [$romance->category_id]],
            ['name' => 'Problematic Summer Romance', 'author' => 'Ali Hazelwood', 'price' => 10.99, 'original_price' => 11.99, 'language' => 'EN', 'rating' => 4, 'amount' => 6, 'release_date' => '2023-06-01', 'is_on_sale' => true, 'photo1' => 'problematic_summer_romance.JPG', 'is_recommended' => true,'categories' => [$romance->category_id]],
            ['name' => 'Polnočná knižnica', 'author' => 'Matt Haig', 'price' => 13.99, 'language' => 'SK', 'rating' => 5, 'amount' => 10, 'release_date' => '2020-08-13', 'is_on_sale' => false, 'photo1' => 'polnocna_kniznica.JPG', 'categories' => [$romance->category_id]],

            // Young Adult
            ['name' => 'Looking for Alaska', 'author' => 'John Green', 'price' => 12.99, 'language' => 'EN', 'rating' => 5, 'amount' => 8, 'release_date' => '2005-03-03', 'is_on_sale' => false, 'photo1' => 'looking_for_alaska.JPG','is_recommended' => true, 'categories' => [$ya->category_id]],
            ['name' => 'Dievča z atramentu a hviezd', 'author' => 'Kiran Millwood Hargrave', 'price' => 12.50, 'language' => 'SK', 'rating' => 4, 'amount' => 9, 'release_date' => '2017-05-04', 'is_on_sale' => false, 'photo1' => 'dievca_z_atramentu_a_hviezd.jpg', 'categories' => [$ya->category_id]],
            ['name' => 'Žltá hviezda', 'author' => 'Jennifer Roy', 'price' => 9.50, 'original_price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 8, 'release_date' => '2006-01-01', 'is_on_sale' => true, 'photo1' => 'zlta_hviezda.JPG', 'categories' => [$ya->category_id]],
            ['name' => 'Struny času', 'author' => 'Madeleine L\'Engle', 'price' => 11.99, 'language' => 'SK', 'rating' => 4, 'amount' => 7, 'release_date' => '1962-01-01', 'is_on_sale' => false, 'photo1' => 'struny_casu.JPG', 'categories' => [$ya->category_id]],
            ['name' => 'Girl in Pieces', 'author' => 'Kathleen Glasgow', 'price' => 12.99, 'language' => 'EN', 'rating' => 5, 'amount' => 10, 'release_date' => '2016-08-30', 'is_on_sale' => false, 'photo1' => 'girl_in_pieces.JPG','is_booktok' => true, 'categories' => [$ya->category_id, $thriller->category_id]],

            // Fantasy
            ['name' => 'Vyhlídka na věčnost', 'author' => 'Jiří Kulhánek', 'price' => 14.99, 'language' => 'CZ', 'rating' => 4, 'amount' => 5, 'release_date' => '2010-01-01', 'is_on_sale' => false, 'photo1' => 'vyhlidka.JPG', 'categories' => [$fantasy->category_id]],
            ['name' => 'Six of Crows', 'author' => 'Leigh Bardugo', 'price' => 13.99, 'language' => 'EN', 'rating' => 5, 'amount' => 10, 'release_date' => '2015-09-29', 'is_on_sale' => false, 'photo1' => 'six_of_crows.JPG','is_booktok' => true, 'categories' => [$fantasy->category_id, $ya->category_id]],
            // Manga
            ['name' => 'Attack on Titan vol.1', 'author' => 'Hajime Isayama','original_price' => 8, 'price' => 10.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15, 'release_date' => '2009-09-09', 'is_on_sale' => true, 'photo1' => 'attack_on_titan_1.JPG', 'categories' => [$manga->category_id]],
            ['name' => 'Attack on Titan vol.2', 'author' => 'Hajime Isayama','original_price' => 8, 'price' => 10.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15, 'release_date' => '2009-12-09', 'is_on_sale' => true, 'photo1' => 'attack_on_titan_2.JPG', 'categories' => [$manga->category_id]],
            ['name' => 'Attack on Titan vol.3', 'author' => 'Hajime Isayama','original_price' => 8,'price' => 10.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15, 'release_date' => '2010-03-09', 'is_on_sale' => true, 'photo1' => 'attack_on_titan_3.JPG', 'categories' => [$manga->category_id]],
            ['name' => 'Attack on Titan vol.4', 'author' => 'Hajime Isayama','original_price' => 8, 'price' => 10.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15, 'release_date' => '2010-06-09', 'is_on_sale' => true, 'photo1' => 'attack_on_titan_4.JPG', 'categories' => [$manga->category_id]],
            ['name' => 'Attack on Titan vol.5', 'author' => 'Hajime Isayama','original_price' => 8, 'price' => 10.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15, 'release_date' => '2010-09-09', 'is_on_sale' => true, 'photo1' => 'attack_on_titan_5.JPG', 'categories' => [$manga->category_id]],

            // Detective
            ['name' => 'Bestia', 'author' => 'Dominik Dán', 'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 12, 'release_date' => '2010-01-01', 'is_on_sale' => false, 'photo1' => 'dan_bestia.JPG', 'categories' => [$detective->category_id]],
            ['name' => 'Smrť', 'author' => 'Dominik Dán', 'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 12, 'release_date' => '2011-01-01', 'is_on_sale' => false, 'photo1' => 'dan_smrt.JPG', 'categories' => [$detective->category_id]],
            ['name' => 'Krv', 'author' => 'Dominik Dán', 'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 12, 'release_date' => '2012-01-01', 'is_on_sale' => false, 'photo1' => 'dan_krv.JPG', 'categories' => [$detective->category_id]],
            ['name' => 'Neodpúšťa', 'author' => 'Dominik Dán', 'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 12, 'release_date' => '2013-01-01', 'is_on_sale' => false, 'photo1' => 'dan_neodpusta.JPG', 'categories' => [$detective->category_id]],
            ['name' => 'Hrob', 'author' => 'Dominik Dán', 'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 12, 'release_date' => '2014-01-01', 'is_on_sale' => false, 'photo1' => 'dan_hrob.JPG', 'categories' => [$detective->category_id]],
            ['name' => 'Pacient', 'author' => 'Sebastian Fitzek', 'price' => 13.50, 'language' => 'SK', 'rating' => 4, 'amount' => 8, 'release_date' => '2008-01-01', 'is_on_sale' => false,'is_booktok' => true, 'photo1' => 'pacient.JPG', 'categories' => [$detective->category_id]],

            // Thriller
            ['name' => 'Sám vojak v poli', 'author' => 'Neznámy', 'price' => 10.99, 'language' => 'SK', 'rating' => 4, 'amount' => 6, 'release_date' => '2000-01-01', 'is_on_sale' => false, 'photo1' => 'sam_vojak.JPG', 'categories' => [$thriller->category_id]],

            // For kids
            ['name' => 'Mimi & Líza: Záhrada', 'author' => 'Katarína Kerekesová', 'price' => 9.99, 'language' => 'SK', 'rating' => 5, 'amount' => 20, 'release_date' => '2018-01-01', 'is_on_sale' => false, 'photo1' => 'mimiliza_zahrada.JPG', 'categories' => [$forkids->category_id]],
            ['name' => 'Mimi & Líza: Vianoce', 'author' => 'Katarína Kerekesová', 'price' => 9.99, 'language' => 'SK', 'rating' => 5, 'amount' => 20, 'release_date' => '2019-01-01', 'is_on_sale' => false, 'photo1' => 'mimiliza_vianoce.JPG', 'categories' => [$forkids->category_id]],
            ['name' => 'Mimi & Líza 2', 'author' => 'Katarína Kerekesová', 'price' => 9.99, 'language' => 'SK', 'rating' => 5, 'amount' => 20, 'release_date' => '2020-01-01', 'is_on_sale' => false, 'photo1' => 'mimiliza_2.JPG', 'categories' => [$forkids->category_id]],
            ['name' => 'Opica Škorica znovu čaruje', 'author' => 'Peter Stoličný', 'price' => 8.99, 'language' => 'SK', 'rating' => 5, 'amount' => 15, 'release_date' => '2015-01-01', 'is_on_sale' => false, 'photo1' => 'opica_caruje.JPG', 'categories' => [$forkids->category_id]],
            ['name' => 'Prázdniny s opicou Škoricou', 'author' => 'Peter Stoličný', 'price' => 8.99, 'language' => 'SK', 'rating' => 5, 'amount' => 15, 'release_date' => '2016-01-01', 'is_on_sale' => false, 'photo1' => 'opica_prazdniny.JPG', 'categories' => [$forkids->category_id]],
            ['name' => 'Vianoce s opicou Škoricou', 'author' => 'Peter Stoličný', 'price' => 8.99, 'language' => 'SK', 'rating' => 5, 'amount' => 15, 'release_date' => '2017-01-01', 'is_on_sale' => false, 'photo1' => 'opica_vianoce.JPG', 'categories' => [$forkids->category_id]],

            // Cooking
            ['name' => 'Pečenie pre deti', 'author' => 'Mladé letá', 'price' => 12.99, 'language' => 'SK', 'rating' => 4, 'amount' => 10, 'release_date' => '2015-01-01', 'is_on_sale' => false, 'photo1' => 'pecenie_pre_deti.JPG', 'categories' => [$cooking->category_id]],
            ['name' => 'Pečieme s Jožkou', 'author' => 'Jozefína Zaukovolcová', 'price' => 13.99, 'language' => 'SK', 'rating' => 4, 'amount' => 8, 'release_date' => '2018-01-01', 'is_on_sale' => false, 'photo1' => 'pecieme_s_jozkou.JPG', 'categories' => [$cooking->category_id]],
            ['name' => 'Talianska kuchárka', 'author' => 'Bo Hagstrom', 'price' => 18.99, 'language' => 'SK', 'rating' => 4, 'amount' => 7, 'release_date' => '2016-01-01', 'is_on_sale' => false, 'photo1' => 'talianska_kucharka.JPG', 'categories' => [$cooking->category_id]],

            // Historical
            ['name' => 'Posledný Žid z Treblinky', 'author' => 'Chil Reichman','original_price' => 15.99, 'price' => 12.99, 'language' => 'SK', 'rating' => 5, 'amount' => 8, 'release_date' => '2006-01-01', 'is_on_sale' => true, 'photo1' => 'posledny_zid.JPG', 'categories' => [$historical->category_id]],
            ['name' => 'Prežil aby odriekal kadiš', 'author' => 'Romi Cohn & Leonard Ciacio', 'price' => 12.99, 'language' => 'SK', 'rating' => 5, 'amount' => 6, 'release_date' => '2008-01-01', 'is_on_sale' => false, 'photo1' => 'prezil.JPG', 'categories' => [$historical->category_id]],
            ['name' => 'Sestrin sľub', 'author' => 'Rena Kornreich Gelissen', 'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 7, 'release_date' => '2007-01-01', 'is_on_sale' => false, 'photo1' => 'sestrin_slub.JPG', 'categories' => [$historical->category_id]],
            ['name' => 'Vojenské omyly druhej svetovej vojny', 'author' => 'Kenneth Macksey', 'price' => 15.99, 'language' => 'SK', 'rating' => 4, 'amount' => 5, 'release_date' => '2005-01-01', 'is_on_sale' => false, 'photo1' => 'vojenske_omyly.JPG', 'categories' => [$historical->category_id]],

            // Encyclopedia
            ['name' => 'Školská encyklopédia', 'author' => 'Mladé letá', 'price' => 19.99, 'language' => 'SK', 'rating' => 4, 'amount' => 10, 'release_date' => '2010-01-01', 'is_on_sale' => false, 'photo1' => 'skolska_encyklopedia.JPG', 'categories' => [$encyclo->category_id]],
        ];

        foreach ($books as $bookData) {
            $categories = $bookData['categories'];
            unset($bookData['categories']);
            $book = Book::create($bookData);
            $book->categories()->attach($categories);
        }
    }
}
