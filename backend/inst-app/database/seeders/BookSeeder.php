<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use App\Models\BookImage;
use App\Models\BookSale;

class BookSeeder extends Seeder
{
    public function run()
    {
        $fantasy    = Category::create(['type' => 'Fantasy']);
        $manga      = Category::create(['type' => 'Manga']);
        $forkids    = Category::create(['type' => 'For kids']);
        $cooking    = Category::create(['type' => 'Cooking']);
        $romance    = Category::create(['type' => 'Romance']);
        $ya         = Category::create(['type' => 'Young Adult']);
        $detective  = Category::create(['type' => 'Detective']);
        $thriller   = Category::create(['type' => 'Thriller']);
        $historical = Category::create(['type' => 'Historical']);
        $encyclo    = Category::create(['type' => 'Encyclopedia']);

        $books = [
            // Romance
            [
                'name' => 'Mate', 'author' => 'Ali Hazelwood',
                'detail' => 'Serena Paris is orphaned, pack-less, and one of a kind. Coming forward as the first Human-Were hybrid was supposed to heal a centuries-long rift between species. Instead, it made her a target, prey to ruthless political machinations between Weres, Vampyres, and Humans. With her enemies closing in, she has only one option left — if the Alpha of the Northwest pack will have her. As Alpha, Koen Alexander commands absolute obedience, and nothing will stop him from keeping his mate safe.',
                'price' => 15.99, 'language' => 'EN', 'rating' => 4, 'amount' => 10,
                'release_date' => '2024-01-01', 'is_booktok' => true,
                'photo' => ['mate.JPG', 'mate_backside.jpeg', 'mate_preview.jpg'], 'categories' => [$romance->category_id, $ya->category_id ],
            ],
            [
                'name' => 'Problematic Summer Romance', 'author' => 'Ali Hazelwood',
                'detail' => 'Maya Killgore is twenty-three and still figuring out her life. Conor Harkness is thirty-eight, and Maya cannot stop thinking about him. The power dynamic is too imbalanced, and any relationship between them would be problematic in too many ways to count. But when Maya\'s brother decides to get married in Taormina, she and Conor end up stuck together in a romantic Sicilian villa for over a week — and not everything is as it seems.',
                'price' => 11.99, 'language' => 'EN', 'rating' => 4, 'amount' => 6,
                'release_date' => '2023-06-01',    'is_recommended' => true,
                'photo' => ['problematic_summer_romance.JPG','problematic_summer_romance_backside.jpg','psr_previw.jpg'], 'categories' => [$romance->category_id, $ya->category_id],
                'sale' => ['price_modifier' => 0.92, 'start_sale' => '2026-01-01', 'end_sale' => '2026-12-31'],
            ],
            [
                'name' => 'Polnočná knižnica', 'author' => 'Matt Haig',
                'detail' => 'Nora Seedová sa ocitne v tajomnej Polnočnej knižnici — mieste medzi životom a smrťou, kde každá kniha predstavuje iný život, ktorý mohla žiť. Dostane šancu preskúmať životy plné iných rozhodnutí a objaviť, čo v skutočnosti znamená žiť naplno. Dojemný román o ľútosti, druhých šanciach a sile nádeje.',
                'price' => 13.99, 'language' => 'SK', 'rating' => 4, 'amount' => 10,
                'release_date' => '2024-08-13', 'is_recommended' => true,
                'photo' => ['polnocna_kniznica.JPG','polnocna_kniznica_backside.jpg', 'pk_preview.jpg'], 'categories' => [$romance->category_id],
            ],

            // Young Adult
            [
                'name' => 'Looking for Alaska', 'author' => 'John Green',
                'detail' => 'Miles Halter leaves his safe life behind to attend a boarding school in Alabama, where he becomes obsessed with the fascinating and self-destructive Alaska Young. A powerful coming-of-age story about love, loss, and the search for meaning. Before and after — nothing is ever the same.',
                'price' => 12.99, 'language' => 'EN', 'rating' => 4, 'amount' => 8,
                'release_date' => '2005-03-03',     'is_recommended' => true,
                'photo' => ['looking_for_alaska.JPG', 'lookinf_for_alaska_backside.jpg','lfa_preview.jpg'], 'categories' => [$ya->category_id, $ya->category_id],
            ],
            [
                'name' => 'Dievča z atramentu a hviezd', 'author' => 'Kiran Millwood Hargrave',
                'detail' => 'Na ostrove Joya žijú ľudia podľa prísnych pravidiel — a ženám je zakázané cestovať. Keď záhadná katastrofa pohltí časť ostrova a Ifesinachina najlepšia priateľka zmizne, ona sa odváži urobiť to, čo je zakázané. Poetický príbeh o odvahe, priateľstve a túžbe po slobode, ktorý zaujme od prvej strany.',
                'price' => 12.50, 'language' => 'SK', 'rating' => 4, 'amount' => 9,
                'release_date' => '2017-05-04', 'is_recommended' => true,
                'photo' => 'dievca_z_atramentu_a_hviezd.jpg', 'categories' => [$ya->category_id],
            ],
            [
                'name' => 'Žltá hviezda', 'author' => 'Jennifer Roy',
                'detail' => 'Skutočný príbeh Sylvie Perlmutterovej — jedného z mála detí, ktoré prežili holokaust v lodžskom gete. Napísaný vo voľnom verši priamo z pohľadu malého dievčaťa. Jednoduchý, no nesmierne silný príbeh o prežití, rodine a nádeji v najtemnejších časoch ľudských dejín.',
                'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 8,
                'release_date' => '2006-01-01',
                'photo' => 'zlta_hviezda.JPG', 'categories' => [$ya->category_id, $historical->category_id],
                'sale' => ['price_modifier' => 0.79, 'start_sale' => '2026-01-01', 'end_sale' => '2026-07-30'],
            ],
            [
                'name' => 'Struny času', 'author' => 'Madeleine L\'Engle',
                'detail' => 'Meg Murryová a jej brat Charles Wallace sa vydávajú na medzigalaktickú cestu časom a priestorom, aby zachránili svojho otca zo spárov temného zla. Klasický fantasy román, ktorý spája vedu s mágiou a nesie hlboké posolstvo o sile lásky a odvahy. Jedna z najvplyvnejších kníh pre mladých čitateľov všetkých čias.',
                'price' => 11.99, 'language' => 'SK', 'rating' => 4, 'amount' => 7,
                'release_date' => '1962-01-01', 'is_recommended' => true,
                'photo' => 'struny_casu.JPG', 'categories' => [$ya->category_id, $fantasy->category_id],
            ],
            [
                'name' => 'Girl in Pieces', 'author' => 'Kathleen Glasgow',
                'detail' => 'Charlie Davis has lost everything — her home, her friends, and nearly her life. After months in a treatment facility, she must find a way to put herself back together in a world that broke her in the first place. Raw, honest, and deeply moving, this is a story about trauma, survival, and the long, painful road to finding yourself again.',
                'price' => 12.99, 'language' => 'EN', 'rating' => 4, 'amount' => 10,
                'release_date' => '2016-08-30', 'is_booktok' => true,
                'photo' => 'girl_in_pieces.JPG', 'categories' => [$ya->category_id, $thriller->category_id],
            ],
            // Fantasy
            [
                'name' => 'Vyhlídka na věčnost', 'author' => 'Jiří Kulhánek',
                'detail' => 'Temná česká fantasy od jednoho z nejoblíbenějších autorů žánru. Příběh plný akce, nadpřirozených bytostí a nezapomenutelných postav, který čtenáře vtáhne do světa, kde hranice mezi životem a smrtí je jen tenká čára. Kulhánek opět dokazuje, proč patří ke špičce středoevropské fantastiky.',
                'price' => 14.99, 'language' => 'CZ', 'rating' => 4, 'amount' => 5,
                'release_date' => '2010-01-01',
                'photo' => 'vyhlidka.JPG', 'categories' => [$fantasy->category_id],
            ],
            [
                'name' => 'Six of Crows', 'author' => 'Leigh Bardugo',
                'detail' => 'Criminal prodigy Kaz Brekker is offered a chance at a deadly heist that could make him rich beyond his wildest dreams — but only if he can assemble a crew of the most dangerous misfits in the city. A masterfully crafted fantasy heist full of complex characters, dark magic, and twists that will keep you reading until dawn. No mourners. No funerals.',
                'price' => 13.99, 'language' => 'EN', 'rating' => 4, 'amount' => 10,
                'release_date' => '2015-09-29', 'is_booktok' => true,
                'photo' => 'six_of_crows.JPG', 'categories' => [$fantasy->category_id],
                'sale' => ['price_modifier' => 0.80, 'start_sale' => '2026-01-01', 'end_sale' => '2026-07-30'],
            ],
            // Manga
            [
                'name' => 'Attack on Titan vol.1', 'author' => 'Hajime Isayama',
                'detail' => 'For over a century, humanity has lived behind enormous walls, protected from the man-eating Titans that roam outside. But when a colossal Titan breaches the wall, young Eren Yeager watches in horror as his world is destroyed. Swearing revenge, he vows to join the fight against the Titans. The legendary manga series begins here — shocking, brutal, and impossible to put down.',
                'price' => 8.00, 'language' => 'EN', 'rating' => 4, 'amount' => 15,
                'release_date' => '2009-09-09',
                'photo' => ['attack_on_titan_1.JPG','aot1_backside.jpg', 'aot1_previw.jpg'], 'categories' => [$manga->category_id, $thriller->category_id ],
                'sale' => ['price_modifier' => 0.90, 'start_sale' => '2026-01-01', 'end_sale' => '2026-12-31'],
            ],
            [
                'name' => 'Attack on Titan vol.2', 'author' => 'Hajime Isayama',
                'detail' => 'Eren, Mikasa, and Armin begin their grueling military training. As the cadets push themselves to the limit, dark secrets about the Titans start to surface. The second volume builds the world and deepens the mystery, setting the stage for shocking revelations that will change everything.',
                'price' => 8.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15,
                'release_date' => '2009-12-09',
                'photo' => ['attack_on_titan_2.JPG','aot2_backside.jpg', 'aot2_preview.jpg'], 'categories' => [$manga->category_id, $thriller->category_id],
                'sale' => ['price_modifier' => 0.90, 'start_sale' => '2026-01-01', 'end_sale' => '2026-12-31'],
            ],
            [
                'name' => 'Attack on Titan vol.3', 'author' => 'Hajime Isayama',
                'detail' => 'Training is over and the cadets face their first real battle. Volume three delivers a massive twist that redefines everything readers thought they knew about the Titans. Isayama proves once again that no one is safe — and the story is only just beginning.',
                'price' => 8.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15,
                'release_date' => '2010-03-09',
                'photo' => ['attack_on_titan_3.JPG', 'aot3_backside.jpg', 'aot3_preview.jpg'], 'categories' => [$manga->category_id, $thriller->category_id],
                'sale' => ['price_modifier' => 0.90, 'start_sale' => '2026-01-01', 'end_sale' => '2026-12-31'],
            ],
            [
                'name' => 'Attack on Titan vol.4', 'author' => 'Hajime Isayama',
                'detail' => 'The Survey Corps ventures beyond the walls on their most dangerous mission yet. Volume four expands the world and uncovers new secrets about the origin of the Titans. Tension is rising, alliances are shifting, and no character is guaranteed to survive.',
                'price' => 8.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15,
                'release_date' => '2010-06-09',
                'photo' => ['attack_on_titan_4.JPG', 'aot4_backside.jpg', 'aot4_preview.jpg'], 'categories' => [$manga->category_id, $thriller->category_id],
                'sale' => ['price_modifier' => 0.90, 'start_sale' => '2026-01-01', 'end_sale' => '2026-12-31'],
            ],
            [
                'name' => 'Attack on Titan vol.5', 'author' => 'Hajime Isayama',
                'detail' => 'Volume five delivers one of the most emotional moments of the entire series. Sacrifices mount as Eren begins to grasp the true scale of the threat they face. Isayama\'s ability to combine brutal action with deeply human moments is on full display in this unforgettable installment.',
                'price' => 8.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15,
                'release_date' => '2010-09-09',
                'photo' => ['attack_on_titan_5.JPG', 'aot5_backside.jpg', 'aot5_preview.jpg'], 'categories' => [$manga->category_id, $thriller->category_id],
                'sale' => ['price_modifier' => 0.90, 'start_sale' => '2026-01-01', 'end_sale' => '2026-12-31'],
            ],

            // Detective
            [
                'name' => 'Bestia', 'author' => 'Dominik Dán',
                'detail' => 'Prvý román zo série o nadporučíkovi Adamovi Dankovi. V Bratislave sa objavuje sériový vrah s nezvyčajným spôsobom konania a Danko dostáva prípad, ktorý ho bude prenasledovať. Dominik Dán, sám bývalý policajt, píše s autenticitou a napätím, ktoré nemá v slovenčine obdobu.',
                'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 12,
                'release_date' => '2010-01-01', 'is_recommended' => true,
                'photo' => 'dan_bestia.JPG', 'categories' => [$detective->category_id, $thriller->category_id],
            ],
            [
                'name' => 'Smrť', 'author' => 'Dominik Dán',
                'detail' => 'Adam Danko sa vracia v ďalšom strhujúcom prípade plnom temných zákutí bratislavského podsvetia. Nová vražda, nové tajomstvá a Danko opäť na hranici zákona aj vlastných síl. Dán potvrdzuje, že slovenská detektívka môže konkurovať tým najlepším svetovým autorom žánru.',
                'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 12,
                'release_date' => '2011-01-01','is_recommended' => true,
                'photo' => 'dan_smrt.JPG', 'categories' => [$detective->category_id, $thriller->category_id],
            ],
            [
                'name' => 'Krv', 'author' => 'Dominik Dán',
                'detail' => 'Brutálna vražda odhalí sieť korupcie a zločinu, ktorá siaha oveľa hlbšie, než sa zdá. Tretí diel série o Adamovi Dankovi mieša autentické policajné prostredie s brilantne vykreslenou psychológiou postáv. Čítanie na jeden dych.',
                'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 12,
                'release_date' => '2012-01-01','is_recommended' => true,
                'photo' => 'dan_krv.JPG', 'categories' => [$detective->category_id, $thriller->category_id],
            ],
            [
                'name' => 'Neodpúšťa', 'author' => 'Dominik Dán',
                'detail' => 'Danko čelí svojmu možno najnebezpečnejšiemu protivníkovi. Prípad, ktorý sa zdá byť jednoduchý, sa rýchlo mení na osobný súboj so zločincom, ktorý neodpúšťa žiadne chyby. Napínavý a atmosferický román, ktorý drží v napätí až do poslednej strany.',
                'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 12,
                'release_date' => '2013-01-01','is_recommended' => true,
                'photo' => 'dan_neodpusta.JPG', 'categories' => [$detective->category_id, $thriller->category_id],
                  'sale' => ['price_modifier' => 0.80, 'start_sale' => '2026-01-01', 'end_sale' => '2026-07-30'],
            ],
            [
                'name' => 'Hrob', 'author' => 'Dominik Dán',
                'detail' => 'Objavenie hrobu otvorí staré rany a vyvolá otázky, na ktoré niekto nechce poznať odpovede. Jeden z najtemnejších prípadov v Dankovej kariére preverí nielen jeho schopnosti, ale aj jeho morálku. Dán potvrdzuje svoju pozíciu kráľa slovenského krimi žánru.',
                'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 12,
                'release_date' => '2014-01-01','is_recommended' => true,
                'photo' => 'dan_hrob.JPG', 'categories' => [$detective->category_id, $thriller->category_id],
                  'sale' => ['price_modifier' => 0.80, 'start_sale' => '2026-01-01', 'end_sale' => '2026-07-30'],
            ],
            [
                'name' => 'Pacient', 'author' => 'Sebastian Fitzek',
                'detail' => 'Psychológ Martin Roth dostane prípad pacienta, ktorý tvrdí, že spácha vraždu — no nevie kedy, kde ani koho. Fitzek, majster psychologického thrilleru, stavia príbeh plný zvratov, kde sa hranica medzi šialenstvom a realitou stráca. Nemožno odložiť, kým neprečítaš poslednú stranu.',
                'price' => 13.50, 'language' => 'SK', 'rating' => 4, 'amount' => 8,
                'release_date' => '2008-01-01',     'is_booktok' => true,
                'photo' => 'pacient.JPG', 'categories' => [$detective->category_id],
            ],

            // Thriller
            [
                'name' => 'Sám vojak v poli', 'author' => 'Neznámy',
                'detail' => 'Napínavý thriller o jednotlivcovi, ktorý sa ocitne sám proti systému. Príbeh plný nebezpečenstva, zrady a odhodlania nevzdať sa ani vtedy, keď všetko stojí proti nemu. Čítanie, ktoré vás udrží v napätí od prvej do poslednej strany.',
                'price' => 10.99, 'language' => 'SK', 'rating' => 4, 'amount' => 6,
                'release_date' => '2000-01-01',
                'photo' => 'sam_vojak.JPG', 'categories' => [$thriller->category_id, $historical->category_id],
            ],

            // For kids
            [
                'name' => 'Mimi & Líza: Záhrada', 'author' => 'Katarína Kerekesová',
                'detail' => 'Mimi a Líza objavujú čaro záhrady — sejú semienka, starajú sa o rastliny a učia sa, odkiaľ pochádza jedlo. Krásne ilustrovaná knižka pre najmenších, ktorá nenásilne učí deti o prírode, trpezlivosti a radosti z pestovania. Obľúbená slovenská séria, ktorá baví celé rodiny.',
                'price' => 9.99, 'language' => 'SK', 'rating' => 5, 'amount' => 20,
                'release_date' => '2018-01-01',
                'photo' => 'mimiliza_zahrada.JPG', 'categories' => [$forkids->category_id],
                  'sale' => ['price_modifier' => 0.80, 'start_sale' => '2026-01-01', 'end_sale' => '2026-07-30'],
            ],
            [
                'name' => 'Mimi & Líza: Vianoce', 'author' => 'Katarína Kerekesová',
                'detail' => 'Mimi a Líza sa tešia na Vianoce a spolu s nimi sa tešiť budú aj najmenší čitatelia. Vianočný diel obľúbenej série prináša atmosféru sviatkov, rodinnej pohody a lásky. Ideálny darček pre deti, ktorý si zamilujú aj rodičia.',
                'price' => 9.99, 'language' => 'SK', 'rating' => 5, 'amount' => 20,
                'release_date' => '2019-01-01',
                'photo' => 'mimiliza_vianoce.JPG', 'categories' => [$forkids->category_id],
                  'sale' => ['price_modifier' => 0.80, 'start_sale' => '2026-01-01', 'end_sale' => '2026-07-30'],
            ],
            [
                'name' => 'Mimi & Líza 2', 'author' => 'Katarína Kerekesová',
                'detail' => 'Mimi a Líza sa vracajú s novými dobrodružstvami, novými priateľmi a novými lekciami o svete okolo nás. Druhý diel obľúbenej série opäť zaujme krásnou ilustráciou a jednoduchým, ale zmysluplným príbehom pre tie najmenšie deti.',
                'price' => 9.99, 'language' => 'SK', 'rating' => 5, 'amount' => 20,
                'release_date' => '2020-01-01',
                'photo' => 'mimiliza_2.JPG', 'categories' => [$forkids->category_id],
            ],
            [
                'name' => 'Opica Škorica znovu čaruje', 'author' => 'Peter Stoličný',
                'detail' => 'Šikovná opica Škorica je späť a opäť čaruje! Plná hravých situácií a veselých ilustrácií, táto knižka rozosmieje každé dieťa. Séria od obľúbeného slovenského autora Petra Stoličného patrí k najčítanejším deťským knihám na Slovensku.',
                'price' => 8.99, 'language' => 'SK', 'rating' => 5, 'amount' => 15,
                'release_date' => '2015-01-01',
                'photo' => 'opica_caruje.JPG', 'categories' => [$forkids->category_id],
            ],
            [
                'name' => 'Prázdniny s opicou Škoricou', 'author' => 'Peter Stoličný',
                'detail' => 'Opica Škorica ide na prázdniny a zažíva kopec zábavy a nečakaných situácií. Veselá knižka plná humoru a milých ilustrácií, ktorá sa perfektne hodí na letné čítanie s deťmi. Ďalší skvelý diel obľúbenej série pre najmenších.',
                'price' => 8.99, 'language' => 'SK', 'rating' => 5, 'amount' => 15,
                'release_date' => '2016-01-01',
                'photo' => 'opica_prazdniny.JPG', 'categories' => [$forkids->category_id],
            ],
            [
                'name' => 'Vianoce s opicou Škoricou', 'author' => 'Peter Stoličný',
                'detail' => 'Opica Škorica sa teší na Vianoce a chystá prekvapenia pre všetkých okolo. Vianočný diel obľúbenej série prináša teplo sviatkov, dobré skutky a veľa smiechu. Krásny darček pre každé dieťa pod stromček.',
                'price' => 8.99, 'language' => 'SK', 'rating' => 5, 'amount' => 15,
                'release_date' => '2017-01-01',
                'photo' => 'opica_vianoce.JPG', 'categories' => [$forkids->category_id],
            ],

            // Cooking
            [
                'name' => 'Pečenie pre deti', 'author' => 'Mladé letá',
                'detail' => 'Zábavná kuchárska kniha plná jednoduchých receptov, ktoré zvládnu aj deti. Od sušienok po koláče — každý recept je podrobne vysvetlený s farebnými obrázkami. Ideálna pre rodiny, ktoré chcú tráviť čas v kuchyni spolu a vytvárať sladké spomienky.',
                'price' => 12.99, 'language' => 'SK', 'rating' => 4, 'amount' => 10,
                'release_date' => '2015-01-01',
                'photo' => 'pecenie_pre_deti.JPG', 'categories' => [$cooking->category_id, $forkids->category_id],
            ],
            [
                'name' => 'Pečieme s Jožkou', 'author' => 'Jozefína Zaukovolcová',
                'detail' => 'Jožka vás zavedie do svojej kuchyne plnej vône čerstvo upečeného chleba, koláčov a sladkostí. Recepty sú jednoduché, prístupné a overené — ideálne pre každého, kto chce začať piecť alebo rozšíriť svoj repertoár. Slovenská kuchárka s dušou a tepom domova.',
                'price' => 13.99, 'language' => 'SK', 'rating' => 4, 'amount' => 8,
                'release_date' => '2018-01-01',
                'photo' => 'pecieme_s_jozkou.JPG', 'categories' => [$cooking->category_id],
                  'sale' => ['price_modifier' => 0.80, 'start_sale' => '2026-01-01', 'end_sale' => '2026-07-30'],
            ],
            [
                'name' => 'Talianska kuchárka', 'author' => 'Bo Hagstrom',
                'detail' => 'Výprava do srdca talianskej kuchyne — od klasickej pasty a pizze až po regionálne špeciality, ktoré sa bežne nevaria mimo Talianska. Každý recept je sprevádzaný krásnymi fotografiami a príbehom o jeho pôvode. Pre všetkých milovníkov talianskej kultúry a dobrého jedla.',
                'price' => 18.99, 'language' => 'SK', 'rating' => 4, 'amount' => 7,
                'release_date' => '2016-01-01',
                'photo' => 'talianska_kucharka.JPG', 'categories' => [$cooking->category_id],
            ],

            // Historical
            [
                'name' => 'Posledný Žid z Treblinky', 'author' => 'Chil Reichman',
                'detail' => 'Chil Reichman bol jedným z mála preživších vyhladzovacieho tábora Treblinka. Toto je jeho svedectvo — surové, bolestivé a nesmierne dôležité. Príbeh, ktorý neslobodno zabudnúť, o ľudskej krutosti, ale aj o neuvierateľnej sile vôle prežiť.',
                'price' => 15.99, 'language' => 'SK', 'rating' => 5, 'amount' => 8,
                'release_date' => '2006-01-01',
                'photo' => 'posledny_zid.JPG', 'categories' => [$historical->category_id],
                'sale' => ['price_modifier' => 0.81, 'start_sale' => '2026-01-01', 'end_sale' => '2026-12-31'],
            ],
            [
                'name' => 'Prežil aby odriekal kadiš', 'author' => 'Romi Cohn & Leonard Ciacio',
                'detail' => 'Skutočný príbeh Romiho Cohna — chlapca z bratislavskej ortodoxnej rodiny, ktorý prežil holokaust vďaka neuveriteľnej odvahe a šťastiu. Dojemná spomienková kniha, ktorá vzdáva hold všetkým, ktorí neprežili, a pripomína dôležitosť pamäti a odovzdávania svedectiev ďalším generáciám.',
                'price' => 12.99, 'language' => 'SK', 'rating' => 5, 'amount' => 6,
                'release_date' => '2008-01-01',
                'photo' => 'prezil.JPG', 'categories' => [$historical->category_id],
            ],
            [
                'name' => 'Sestrin sľub', 'author' => 'Rena Kornreich Gelissen',
                'detail' => 'Rena Kornreich bola jednou z prvých žien deportovaných do Osvienčimu. Prežila vďaka sľubu, ktorý dala sestre — že sa o ňu postará za každých okolností. Silný a hlboko ľudský príbeh o sile súrodeneckej lásky a odhodlaní prežiť aj v tých najhorších podmienkach.',
                'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 7,
                'release_date' => '2007-01-01',
                'photo' => 'sestrin_slub.JPG', 'categories' => [$historical->category_id],
            ],
            [
                'name' => 'Vojenské omyly druhej svetovej vojny', 'author' => 'Kenneth Macksey',
                'detail' => 'Analytický pohľad na najväčšie strategické a taktické chyby druhej svetovej vojny — od Hitlerovho napadnutia Sovietskeho zväzu až po rozhodnutia spojencov. Macksey skúma, ako iné rozhodnutia mohli zmeniť priebeh vojny, a prináša fascinujúci pohľad na vojenskú históriu.',
                'price' => 15.99, 'language' => 'SK', 'rating' => 4, 'amount' => 5,
                'release_date' => '2005-01-01',
                'photo' => 'vojenske_omyly.JPG', 'categories' => [$historical->category_id],
            ],

            // Encyclopedia
            [
                'name' => 'Školská encyklopédia', 'author' => 'Mladé letá',
                'detail' => 'Komplexná encyklopédia určená školákom, ktorá pokrýva témy od prírodovedy a histórie až po geografi a kultúru. Prehľadne usporiadaná, bohatá na ilustrácie a mapy. Nenahraditeľný pomocník pri učení aj pri uspokojovaní detskej zvedavosti.',
                'price' => 19.99, 'language' => 'SK', 'rating' => 4, 'amount' => 10,
                'release_date' => '2010-01-01',
                'photo' => 'skolska_encyklopedia.JPG', 'categories' => [$encyclo->category_id],  'sale' => ['price_modifier' => 0.80, 'start_sale' => '2026-01-01', 'end_sale' => '2026-07-30'],
            ],
            // Attack on Titan (manga)
            [
                'name' => 'Attack on Titan vol.7', 'author' => 'Hajime Isayama',
                'detail' => 'The Survey Corps launches a desperate mission beyond the walls. With the Female Titan closing in on Eren, old alliances are tested and new horrors emerge. Volume seven is a relentless, breathtaking chapter in the saga.',
                'price' => 8.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15,
                'release_date' => '2011-06-09',
                'photo' => 'attack_on_titan_7.JPG', 'categories' => [$manga->category_id, $thriller->category_id],
                'sale' => ['price_modifier' => 0.90, 'start_sale' => '2026-01-01', 'end_sale' => '2026-12-31'],
            ],
            [
                'name' => 'Attack on Titan vol.8', 'author' => 'Hajime Isayama',
                'detail' => 'The identity of the Female Titan is finally revealed, shattering everything Eren and his comrades believed. Volume eight delivers one of the most shocking and emotionally devastating moments in the entire series.',
                'price' => 8.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15,
                'release_date' => '2011-09-09',
                'photo' => 'attack_on_titan_8.JPG', 'categories' => [$manga->category_id, $thriller->category_id],
                'sale' => ['price_modifier' => 0.90, 'start_sale' => '2026-01-01', 'end_sale' => '2026-12-31'],
            ],
            [
                'name' => 'Attack on Titan vol.9', 'author' => 'Hajime Isayama',
                'detail' => 'In the aftermath of devastating losses, the Scout Regiment must regroup and face new political threats from within the walls. The story deepens as Isayama reveals that humanity\'s greatest enemy may not be the Titans at all.',
                'price' => 8.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15,
                'release_date' => '2011-12-09',
                'photo' => 'attack_on_titan_9.JPG', 'categories' => [$manga->category_id, $thriller->category_id],
                'sale' => ['price_modifier' => 0.90, 'start_sale' => '2026-01-01', 'end_sale' => '2026-12-31'],
            ],
            [
                'name' => 'Attack on Titan vol.10', 'author' => 'Hajime Isayama',
                'detail' => 'A new arc begins as the truth about the walls starts to crack open. Volume ten expands the world of Attack on Titan in ways that will redefine everything the reader thought they understood about humanity\'s last stronghold.',
                'price' => 8.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15,
                'release_date' => '2012-03-09',
                'photo' => 'attack_on_titan_10.JPG', 'categories' => [$manga->category_id, $thriller->category_id],
                'sale' => ['price_modifier' => 0.90, 'start_sale' => '2026-01-01', 'end_sale' => '2026-12-31'],
            ],
            [
                'name' => 'Attack on Titan vol.29', 'author' => 'Hajime Isayama',
                'detail' => 'The penultimate volume of the legendary series. Eren\'s plan reaches its most devastating phase as the Rumbling reshapes the world. Alliances that were unthinkable must now be forged to stop him. The end is near.',
                'price' => 8.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15,
                'release_date' => '2021-04-09',
                'photo' => 'attack_on_titan_29.JPG', 'categories' => [$manga->category_id, $thriller->category_id],
                'sale' => ['price_modifier' => 0.90, 'start_sale' => '2026-01-01', 'end_sale' => '2026-12-31'],
            ],

// Spy x Family (manga)
            [
                'name' => 'Spy x Family vol.1', 'author' => 'Tatsuya Endo',
                'detail' => 'A spy, an assassin, and a telepathic girl — each hiding their true identity from the others — must pose as a family. Tatsuya Endo\'s wildly inventive manga blends action, comedy, and heart in a premise unlike anything else in the medium.',
                'price' => 8.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15,
                'release_date' => '2019-07-04', 'is_recommended' => true,
                'photo' => 'spyxfamily1.JPG', 'categories' => [$manga->category_id, $forkids->category_id],
            ],
            [
                'name' => 'Spy x Family vol.2', 'author' => 'Tatsuya Endo',
                'detail' => 'Loid\'s mission to infiltrate elite school Eden Academy continues, and Anya\'s hilarious attempts to pass the entrance exam steal every scene. Volume two deepens the bond between the fake family in ways that feel surprisingly real.',
                'price' => 8.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15,
                'release_date' => '2019-11-07', 'is_recommended' => true,
                'photo' => 'spyxfamily2.JPG', 'categories' => [$manga->category_id, $forkids->category_id],
            ],
            [
                'name' => 'Spy x Family vol.4', 'author' => 'Tatsuya Endo',
                'detail' => 'Anya navigates the social minefield of Eden Academy while Yor\'s past begins to surface. Volume four raises the stakes and delivers more of the perfectly balanced humour and action that made this series a worldwide phenomenon.',
                'price' => 8.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15,
                'release_date' => '2020-07-02', 'is_recommended' => true,
                'photo' => 'spyxfamily4.JPG', 'categories' => [$manga->category_id, $forkids->category_id],
            ],

// For kids
            [
                'name' => 'O slávkovom neslávnom konci', 'author' => 'Tim Burton',
                'detail' => 'Temne poetická knižka od Tima Burtona, tvorcu Beetlejuice a Nočnej mory pred Vianocami. Príbehy o nešťastných deťoch s nešťastnými konmi vyrozprávané s čiernym humorom a neopakovateľnými ilustráciami. Pre tých, ktorí milujú trochu tmy vo svojich rozprávkach.',
                'price' => 12.99, 'language' => 'SK', 'rating' => 4, 'amount' => 10,
                'release_date' => '1997-01-01',
                'photo' => 'burton.JPG', 'categories' => [$forkids->category_id],
            ],
            [
                'name' => 'Čarodejnica z Turlinghamu', 'author' => 'Ellie Boswellová',
                'detail' => 'Sophiin svet sa obráti naruby, keď objaví, že pochádza z rodu čarodejníc. V škole v Turlinghamu sa musí naučiť ovládať magiu, nájsť si priateľov a zachrániť to, čo je jej najdrahšie. Začiatok pútavej série pre mladých čitateľov s láskou k príbehom o čarách a priateľstve.',
                'price' => 10.99, 'language' => 'SK', 'rating' => 4, 'amount' => 12,
                'release_date' => '2019-01-01',
                'photo' => 'carodejnice_carodejnica.JPG', 'categories' => [$forkids->category_id, $ya->category_id],
            ],
            [
                'name' => 'Čary a tajomstvá', 'author' => 'Ellie Boswellová',
                'detail' => 'Sophie sa vracia s novými čarmi a novými tajomstvami, ktoré ohrozujú nielen jej rodinu, ale celý magický svet. Druhý diel série Ellie Boswellovej prináša viac vzrušenia, humoru a nečakaných zvratov — ideálne pre mladých čitateľov, ktorí milujú dobrodružstvo.',
                'price' => 10.99, 'language' => 'SK', 'rating' => 4, 'amount' => 12,
                'release_date' => '2019-06-01',
                'photo' => 'carodejnice_cary.JPG', 'categories' => [$forkids->category_id, $ya->category_id],
            ],
            [
                'name' => 'Mágia v utajení', 'author' => 'Ellie Boswellová',
                'detail' => 'Tretí diel série o čarodejnici Sophii. Tajomstvá sa prehlbujú a nebezpečenstvo rastie — no Sophie sa nevzdáva. Boswellová opäť dokazuje, že vie písať príbehy, ktoré chytia od prvej strany a nepustia, kým neprečítate tú poslednú.',
                'price' => 10.99, 'language' => 'SK', 'rating' => 4, 'amount' => 12,
                'release_date' => '2020-01-01',
                'photo' => 'carodejnice_magia.JPG', 'categories' => [$forkids->category_id, $ya->category_id],
            ],
            [
                'name' => 'Malý biely koník', 'author' => 'Elizabeth Goudgedová',
                'detail' => 'Maria Merryweatherová prichádza do tajomného sídla Moonacre Manor a objavuje čarovný svet plný záhad, zvierat a pradávneho kliatby, ktorú musí zlomiť. Klasická britská fantasy pre deti, ktorá inšpirovala generácie čitateľov a je plná poetickej krásy a dobrodružstva.',
                'price' => 10.99, 'language' => 'SK', 'rating' => 5, 'amount' => 10,
                'release_date' => '1946-01-01', 'is_recommended' => true,
                'photo' => 'maly_biely_konik.JPG', 'categories' => [$forkids->category_id, $fantasy->category_id],
            ],
            [
                'name' => 'Taká čudná jar', 'author' => 'Hana Zelinová',
                'detail' => 'Klasická slovenská rozprávková próza od Hany Zelinovej. Príbeh plný poézie, prírody a čudných stretnutí, ktoré menú pohľad hrdinky na svet okolo nej. Kniha, ktorá je súčasťou slovenského kultúrneho dedičstva a stále oslovuje nové generácie mladých čitateľov.',
                'price' => 9.99, 'language' => 'SK', 'rating' => 4, 'amount' => 8,
                'release_date' => '1966-01-01',
                'photo' => 'cudna_jar.JPG', 'categories' => [$forkids->category_id, $ya->category_id],
            ],

// Encyclopedia
            [
                'name' => 'Obrazová encyklopédia koní', 'author' => 'Elwyn Hartley Edwards',
                'detail' => 'Vyčerpávajúci vizuálny sprievodca svetom koní od uznávaného odborníka. Pokrýva stovky plemien z celého sveta, históriu domestikácie, jazdecké disciplíny a starostlivosť o koňa. Bohatá fotografická príloha robí z tejto knihy povinnosť pre každého milovníka koní.',
                'price' => 22.99, 'language' => 'CZ', 'rating' => 5, 'amount' => 6,
                'release_date' => '2000-01-01',
                'photo' => 'encyklopedia_koni.JPG', 'categories' => [$encyclo->category_id],
            ],
            [
                'name' => 'Formula 1: Oficiálna história', 'author' => 'Maurice Hamilton',
                'detail' => 'Autorizovaná história najprestížnejšieho motoristického šampionátu sveta od novinára a experta Mauricea Hamiltona. Od prvých pretekov v roku 1950 až po súčasnosť — legendárni jazdci, revolučné monoposty a nezabudnuteľné sezóny zdokumentované s výnimočnou presnosťou a zásobou unikátnych fotografií.',
                'price' => 29.99, 'language' => 'SK', 'rating' => 5, 'amount' => 5,
                'release_date' => '2009-01-01',
                'photo' => 'formula1.JPG', 'categories' => [$encyclo->category_id],
            ],

// Historical / Literary fiction
            [
                'name' => 'Anna In v hrobkách sveta', 'author' => 'Olga Tokarczuk',
                'detail' => 'Nobelistka Olga Tokarczuková reimaginuje prastarý sumerský mýtus o zostupe bohyne Inanny do podsvetia. Poetický, ženský a nesmierne moderný román, ktorý skúma smrť, moc a transformáciu cez prizmu jednej z najstarších príbehových tradícií ľudstva.',
                'price' => 14.99, 'language' => 'SK', 'rating' => 4, 'amount' => 8,
                'release_date' => '2017-01-01', 'is_recommended' => true,
                'photo' => 'hrobky_sveta.JPG', 'categories' => [$historical->category_id],
            ],
            [
                'name' => 'Odložený život', 'author' => 'Dita Kraus',
                'detail' => 'Memoáre Dity Krausovej — skutočnej "knihovníčky z Osvienčimu". Dojemné a mimoriadne čitateľné svedectvo o prežití koncentračného tábora, o živote po oslobodení a o sile pamäti. Jedna z najdôležitejších slovensky vydaných kníh o holokauste posledných rokov.',
                'price' => 13.99, 'language' => 'SK', 'rating' => 5, 'amount' => 8,
                'release_date' => '2020-01-01', 'is_recommended' => true,
                'photo' => 'odlozeny_zivot.JPG', 'categories' => [$historical->category_id],
            ],

// Non-fiction / Religious
            [
                'name' => 'Cyril Vasil: Kresťan by mal byť hrdinom', 'author' => 'Jozef Majchrák, Martin Hanus',
                'detail' => 'Rozhovorová kniha s Cyrilom Vasilom — slovenským kňazom a vysokým vatikánskym predstaviteľom. Majchrák a Hanus vedú s Vasilom otvorený a hlboký dialóg o viere, politike, Cirkvi a o tom, čo znamená byť kresťanom v dnešnom svete. Intelektuálne podnetné a duchovne obohacujúce čítanie.',
                'price' => 14.99, 'language' => 'SK', 'rating' => 4, 'amount' => 7,
                'release_date' => '2022-01-01',
                'photo' => 'krestan_hrdina.JPG', 'categories' => [$encyclo->category_id],
            ],
            [
                'name' => 'Mária', 'author' => 'Francine Riversová',
                'detail' => 'Prvý diel série Výnimočné biblické ženy od bestsellerovej autorky Francine Riversovej. Hlboko ľudský a emotívny pohľad na život Márie — matky Ježiša Krista. Riversová oživuje biblickú postavu s úžasnou literárnou silou a dáva jej hlas, ktorý rezonuje naprieč vekmi.',
                'price' => 12.99, 'language' => 'SK', 'rating' => 4, 'amount' => 8,
                'release_date' => '2002-01-01',
                'photo' => 'maria.JPG', 'categories' => [$historical->category_id, $romance->category_id],
            ],

// Cooking
            [
                'name' => 'Kuchyňa Lidla: 100 receptov z kuchyne Lidla', 'author' => 'Lidl',
                'detail' => 'Sto overených receptov inšpirovaných produktmi z Lidla — od jednoduchých večerí cez sviatočné špeciality až po zdravé každodenné jedlá. Praktická kuchárka, ktorá dokazuje, že výborne variť sa dá aj bez drahých surovín. Ideálna pre každú domácnosť.',
                'price' => 9.99, 'language' => 'SK', 'rating' => 3, 'amount' => 15,
                'release_date' => '2022-01-01',
                'photo' => 'lidl_kucharka.JPG', 'categories' => [$cooking->category_id],
            ],

// Young Adult
            [
                'name' => 'Každodenná', 'author' => 'Simona Malková',
                'detail' => 'Slovenská autorka Simona Malková prináša úprimný a odvážny román o každodennosti dospievania — o láske, identite, vzťahoch a hľadaní seba samého. Písaný so srdcom a citom pre detail, ktorý osloví každého, kto si pamätá, aké ťažké — a krásne — bolo byť mladý.',
                'price' => 11.99, 'language' => 'SK', 'rating' => 4, 'amount' => 10,
                'release_date' => '2023-01-01',
                'photo' => 'kazdodenna.JPG', 'categories' => [$ya->category_id, $romance->category_id],
            ],
            [
                'name' => 'Toto je moje srdce', 'author' => 'C.C. Hunterová',
                'detail' => 'Záver obľúbenej série od C.C. Huntera plný emócií, nebezpečenstva a konečných odpovedí. Hrdinovia čelia poslednej výzve, ktorá preverí nielen ich nadprirodzené schopnosti, ale aj ich srdcia. Pre fanúšikov série nezabudnuteľné vyvrcholenie.',
                'price' => 12.99, 'language' => 'SK', 'rating' => 4, 'amount' => 8,
                'release_date' => '2018-01-01',
                'photo' => 'moje_srdce.JPG', 'categories' => [$ya->category_id, $fantasy->category_id],
            ],
            [
                'name' => 'Žatva smrti III: Nimbus', 'author' => 'Neal Shusterman',
                'detail' => 'Tretí diel série Žatva smrti prináša nový príbeh v dystopickom svete, kde smrť ovládajú Žatevníci. Nimbus rozširuje universum o nové perspektívy a mrazivé odhalenia. Shustermanova bravúrna schopnosť vytvárať morálne dilemy vrcholí v ďalšom strhujúcom dieli.',
                'price' => 13.99, 'language' => 'SK', 'rating' => 4, 'amount' => 10,
                'release_date' => '2022-01-01', 'is_booktok' => true,
                'photo' => 'kosec_nimbus.JPG', 'categories' => [$ya->category_id, $fantasy->category_id],
            ],

// Romance — Ali Hazelwood
            [
                'name' => 'Check & Mate', 'author' => 'Ali Hazelwood',
                'detail' => 'Mallory Greenleaf swore off chess years ago — until one tournament forces her back to the board and into the orbit of Nolan Sawyer, the reigning world champion. Their rivalry is as fierce as their chemistry. A witty, slow-burn romance that proves you can fall in love across the board.',
                'price' => 12.99, 'language' => 'EN', 'rating' => 4, 'amount' => 10,
                'release_date' => '2023-11-07', 'is_booktok' => true,
                'photo' => 'check_mate.JPG', 'categories' => [$romance->category_id, $ya->category_id],
            ],
            [
                'name' => 'Loathe to Love You', 'author' => 'Ali Hazelwood',
                'detail' => 'Three stories, three scientists, one irresistible formula: forced proximity + enemies-to-lovers = the perfect romance. Ali Hazelwood\'s signature blend of STEM heroines, slow burns, and laugh-out-loud dialogue makes this collection impossible to put down.',
                'price' => 12.99, 'language' => 'EN', 'rating' => 4, 'amount' => 8,
                'release_date' => '2022-07-12', 'is_booktok' => true,
                'photo' => 'lothe_to_love_you.JPG', 'categories' => [$romance->category_id],
            ],
            [
                'name' => 'Love on the Brain', 'author' => 'Ali Hazelwood',
                'detail' => 'Neuroscientist Bee Königswasser lands her dream NASA project — only to be paired with her nemesis, Levi Ward. As they work side by side, the line between rivalry and something more begins to blur. A sharp, funny, and deeply romantic novel that proves hating someone is just one step away from loving them.',
                'price' => 12.99, 'language' => 'EN', 'rating' => 4, 'amount' => 10,
                'release_date' => '2022-08-23', 'is_booktok' => true,
                'photo' => 'love_on_the_brain.JPG', 'categories' => [$romance->category_id],
            ],
            [
                'name' => 'Love Theoretically', 'author' => 'Ali Hazelwood',
                'detail' => 'Elsie Hannaway is a physics PhD student who moonlights as a professional fake girlfriend — and her latest client turns out to be the brother of her academic nemesis. Smart, funny, and full of heart, Love Theoretically is Ali Hazelwood at her most delightfully chaotic best.',
                'price' => 12.99, 'language' => 'EN', 'rating' => 4, 'amount' => 10,
                'release_date' => '2023-06-13', 'is_booktok' => true,
                'photo' => 'love_theoretically.JPG', 'categories' => [$romance->category_id],
            ],
            [
                'name' => 'Not in Love', 'author' => 'Ali Hazelwood',
                'detail' => 'Rue is a scientist who doesn\'t believe in love. Eli is the man trying to acquire her company. Their arrangement is strictly physical — until it isn\'t. Ali Hazelwood returns to her signature formula of brainy heroines and slow-burn tension with a story that is smarter and steamier than ever.',
                'price' => 13.99, 'language' => 'EN', 'rating' => 4, 'amount' => 10,
                'release_date' => '2024-06-04', 'is_booktok' => true,
                'photo' => 'not_in_love.JPG', 'categories' => [$romance->category_id],
            ],
            [
                'name' => 'The Love Hypothesis', 'author' => 'Ali Hazelwood',
                'detail' => 'When third-year PhD student Olive Smith needs a fake boyfriend to convince her best friend she has moved on, she spontaneously kisses the first man she sees — who turns out to be Dr. Adam Carlsen, the most notoriously difficult professor on campus. The novel that launched Ali Hazelwood to stardom.',
                'price' => 12.99, 'language' => 'EN', 'rating' => 4, 'amount' => 12,
                'release_date' => '2021-09-14', 'is_booktok' => true,
                'photo' => 'the_love_hypothesis.JPG', 'categories' => [$romance->category_id],
            ],
            [
                'name' => 'Two Can Play', 'author' => 'Ali Hazelwood',
                'detail' => 'A battle of wills between two competitive scientists who would rather win than admit they might be falling for each other. Ali Hazelwood delivers another witty enemies-to-lovers story packed with STEM banter, slow burn tension, and the kind of ending that leaves you smiling for days.',
                'price' => 13.99, 'language' => 'EN', 'rating' => 4, 'amount' => 10,
                'release_date' => '2025-02-04', 'is_booktok' => true,
                'photo' => 'two_can_play.JPG', 'categories' => [$romance->category_id],
            ],
            [
                'name' => 'Bride', 'author' => 'Ali Hazelwood',
                'detail' => 'Misery Lark is a vampire sent to marry a werewolf Alpha as part of a political alliance she never asked for. But nothing about Lowe Moreland is what she expected — and neither is what she begins to feel. A dark, swoony paranormal romance from the queen of slow burns.',
                'price' => 13.99, 'language' => 'EN', 'rating' => 4, 'amount' => 10,
                'release_date' => '2024-03-05', 'is_booktok' => true,
                'photo' => 'bride.JPG', 'categories' => [$romance->category_id, $fantasy->category_id],
            ],
        ];

        foreach ($books as $bookData) {
            $categories = $bookData['categories'];
            $saleData   = $bookData['sale'] ?? null;
            $photo      = $bookData['photo'] ?? null;
            unset($bookData['categories'], $bookData['sale'], $bookData['photo']);

            $book = Book::create($bookData);
            $book->categories()->attach($categories);

            if ($photo) {
                $photos = is_array($photo) ? $photo : [$photo];
                foreach ($photos as $index => $filename) {
                    BookImage::create([
                        'book_id'  => $book->book_id,
                        'filename' => $filename,
                        'order'    => $index + 1,
                    ]);
                }
            }

            if ($saleData) {
                BookSale::create([
                    'book_id'        => $book->book_id,
                    'price_modifier' => $saleData['price_modifier'],
                    'start_sale'     => $saleData['start_sale'],
                    'end_sale'       => $saleData['end_sale'],
                ]);

            }
        }
    }
}
