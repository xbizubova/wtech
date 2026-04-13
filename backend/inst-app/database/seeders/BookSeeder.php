<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run()
    {
        $fantasy = Category::create(['type' => 'Fantasy']);
        $manga = Category::create(['type' => 'Manga']);
        $forkids = Category::create(['type' => 'For kids']);
        $cooking = Category::create(['type' => 'Cooking']);
        $romance = Category::create(['type' => 'Romance']);
        $ya = Category::create(['type' => 'Young Adult']);
        $detective = Category::create(['type' => 'Detective']);
        $thriller = Category::create(['type' => 'Thriller']);
        $historical = Category::create(['type' => 'Historical']);
        $encyclo = Category::create(['type' => 'Encyclopedia']);

        $books = [
            // Romance
            [
                'name' => 'Mate',
                'author' => 'Ali Hazelwood',
                'detail' => 'Serena Paris is orphaned, pack-less, and one of a kind. Coming forward as the first Human-Were hybrid was supposed to heal a centuries-long rift between species. Instead, it made her a target, prey to ruthless political machinations between Weres, Vampyres, and Humans. With her enemies closing in, she has only one option left — if the Alpha of the Northwest pack will have her. As Alpha, Koen Alexander commands absolute obedience, and nothing will stop him from keeping his mate safe.',
                'price' => 15.99, 'language' => 'EN', 'rating' => 4, 'amount' => 10,
                'release_date' => '2024-01-01', 'is_on_sale' => false, 'photo1' => 'mate.JPG',
                'is_booktok' => true, 'categories' => [$romance->category_id]
            ],
            [
                'name' => 'Problematic Summer Romance',
                'author' => 'Ali Hazelwood',
                'detail' => 'Maya Killgore is twenty-three and still figuring out her life. Conor Harkness is thirty-eight, and Maya cannot stop thinking about him. The power dynamic is too imbalanced, and any relationship between them would be problematic in too many ways to count. But when Maya\'s brother decides to get married in Taormina, she and Conor end up stuck together in a romantic Sicilian villa for over a week — and not everything is as it seems.',
                'price' => 10.99, 'original_price' => 11.99, 'language' => 'EN', 'rating' => 4, 'amount' => 6,
                'release_date' => '2023-06-01', 'is_on_sale' => true, 'photo1' => 'problematic_summer_romance.JPG',
                'is_recommended' => true, 'categories' => [$romance->category_id]
            ],
            [
                'name' => 'Polnočná knižnica',
                'author' => 'Matt Haig',
                'detail' => 'Nora Seedová sa ocitne v tajomnej Polnočnej knižnici — mieste medzi životom a smrťou, kde každá kniha predstavuje iný život, ktorý mohla žiť. Dostane šancu preskúmať životy plné iných rozhodnutí a objaviť, čo v skutočnosti znamená žiť naplno. Dojemný román o ľútosti, druhých šanciach a sile nádeje.',
                'price' => 13.99, 'language' => 'SK', 'rating' => 4, 'amount' => 10,
                'release_date' => '2020-08-13', 'is_on_sale' => false, 'photo1' => 'polnocna_kniznica.JPG',
                'categories' => [$romance->category_id]
            ],

            // Young Adult
            [
                'name' => 'Looking for Alaska',
                'author' => 'John Green',
                'detail' => 'Miles Halter leaves his safe life behind to attend a boarding school in Alabama, where he becomes obsessed with the fascinating and self-destructive Alaska Young. A powerful coming-of-age story about love, loss, and the search for meaning. Before and after — nothing is ever the same.',
                'price' => 12.99, 'language' => 'EN', 'rating' => 4, 'amount' => 8,
                'release_date' => '2005-03-03', 'is_on_sale' => false, 'photo1' => 'looking_for_alaska.JPG',
                'is_recommended' => true, 'categories' => [$ya->category_id]
            ],
            [
                'name' => 'Dievča z atramentu a hviezd',
                'author' => 'Kiran Millwood Hargrave',
                'detail' => 'Na ostrove Joya žijú ľudia podľa prísnych pravidiel — a ženám je zakázané cestovať. Keď záhadná katastrofa pohltí časť ostrova a Ifesinachina najlepšia priateľka zmizne, ona sa odváži urobiť to, čo je zakázané. Poetický príbeh o odvahe, priateľstve a túžbe po slobode, ktorý zaujme od prvej strany.',
                'price' => 12.50, 'language' => 'SK', 'rating' => 4, 'amount' => 9,
                'release_date' => '2017-05-04', 'is_on_sale' => false, 'photo1' => 'dievca_z_atramentu_a_hviezd.jpg',
                'categories' => [$ya->category_id]
            ],
            [
                'name' => 'Žltá hviezda',
                'author' => 'Jennifer Roy',
                'detail' => 'Skutočný príbeh Sylvie Perlmutterovej — jedného z mála detí, ktoré prežili holokaust v lodžskom gete. Napísaný vo voľnom verši priamo z pohľadu malého dievčaťa. Jednoduchý, no nesmierne silný príbeh o prežití, rodine a nádeji v najtemnejších časoch ľudských dejín.',
                'price' => 9.50, 'original_price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 8,
                'release_date' => '2006-01-01', 'is_on_sale' => true, 'photo1' => 'zlta_hviezda.JPG',
                'categories' => [$ya->category_id]
            ],
            [
                'name' => 'Struny času',
                'author' => 'Madeleine L\'Engle',
                'detail' => 'Meg Murryová a jej brat Charles Wallace sa vydávajú na medzigalaktickú cestu časom a priestorom, aby zachránili svojho otca zo spárov temného zla. Klasický fantasy román, ktorý spája vedu s mágiou a nesie hlboké posolstvo o sile lásky a odvahy. Jedna z najvplyvnejších kníh pre mladých čitateľov všetkých čias.',
                'price' => 11.99, 'language' => 'SK', 'rating' => 4, 'amount' => 7,
                'release_date' => '1962-01-01', 'is_on_sale' => false, 'photo1' => 'struny_casu.JPG',
                'categories' => [$ya->category_id]
            ],
            [
                'name' => 'Girl in Pieces',
                'author' => 'Kathleen Glasgow',
                'detail' => 'Charlie Davis has lost everything — her home, her friends, and nearly her life. After months in a treatment facility, she must find a way to put herself back together in a world that broke her in the first place. Raw, honest, and deeply moving, this is a story about trauma, survival, and the long, painful road to finding yourself again.',
                'price' => 12.99, 'language' => 'EN', 'rating' => 4, 'amount' => 10,
                'release_date' => '2016-08-30', 'is_on_sale' => false, 'photo1' => 'girl_in_pieces.JPG',
                'is_booktok' => true, 'categories' => [$ya->category_id, $thriller->category_id]
            ],

            // Fantasy
            [
                'name' => 'Vyhlídka na věčnost',
                'author' => 'Jiří Kulhánek',
                'detail' => 'Temná česká fantasy od jednoho z nejoblíbenějších autorů žánru. Příběh plný akce, nadpřirozených bytostí a nezapomenutelných postav, který čtenáře vtáhne do světa, kde hranice mezi životem a smrtí je jen tenká čára. Kulhánek opět dokazuje, proč patří ke špičce středoevropské fantastiky.',
                'price' => 14.99, 'language' => 'CZ', 'rating' => 4, 'amount' => 5,
                'release_date' => '2010-01-01', 'is_on_sale' => false, 'photo1' => 'vyhlidka.JPG',
                'categories' => [$fantasy->category_id]
            ],
            [
                'name' => 'Six of Crows',
                'author' => 'Leigh Bardugo',
                'detail' => 'Criminal prodigy Kaz Brekker is offered a chance at a deadly heist that could make him rich beyond his wildest dreams — but only if he can assemble a crew of the most dangerous misfits in the city. A masterfully crafted fantasy heist full of complex characters, dark magic, and twists that will keep you reading until dawn. No mourners. No funerals.',
                'price' => 13.99, 'language' => 'EN', 'rating' => 4, 'amount' => 10,
                'release_date' => '2015-09-29', 'is_on_sale' => false, 'photo1' => 'six_of_crows.JPG',
                'is_booktok' => true, 'categories' => [$fantasy->category_id, $ya->category_id]
            ],

            // Manga
            [
                'name' => 'Attack on Titan vol.1',
                'author' => 'Hajime Isayama',
                'detail' => 'For over a century, humanity has lived behind enormous walls, protected from the man-eating Titans that roam outside. But when a colossal Titan breaches the wall, young Eren Yeager watches in horror as his world is destroyed. Swearing revenge, he vows to join the fight against the Titans. The legendary manga series begins here — shocking, brutal, and impossible to put down.',
                'original_price' => 10.00, 'price' => 8.00, 'language' => 'EN', 'rating' => 4, 'amount' => 15,
                'release_date' => '2009-09-09', 'is_on_sale' => true, 'photo1' => 'attack_on_titan_1.JPG',
                'categories' => [$manga->category_id]
            ],
            [
                'name' => 'Attack on Titan vol.2',
                'author' => 'Hajime Isayama',
                'detail' => 'Eren, Mikasa, and Armin begin their grueling military training. As the cadets push themselves to the limit, dark secrets about the Titans start to surface. The second volume builds the world and deepens the mystery, setting the stage for shocking revelations that will change everything.',
                'original_price' => 10.00, 'price' => 8.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15,
                'release_date' => '2009-12-09', 'is_on_sale' => true, 'photo1' => 'attack_on_titan_2.JPG',
                'categories' => [$manga->category_id]
            ],
            [
                'name' => 'Attack on Titan vol.3',
                'author' => 'Hajime Isayama',
                'detail' => 'Training is over and the cadets face their first real battle. Volume three delivers a massive twist that redefines everything readers thought they knew about the Titans. Isayama proves once again that no one is safe — and the story is only just beginning.',
                'original_price' => 10.00, 'price' => 8.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15,
                'release_date' => '2010-03-09', 'is_on_sale' => true, 'photo1' => 'attack_on_titan_3.JPG',
                'categories' => [$manga->category_id]
            ],
            [
                'name' => 'Attack on Titan vol.4',
                'author' => 'Hajime Isayama',
                'detail' => 'The Survey Corps ventures beyond the walls on their most dangerous mission yet. Volume four expands the world and uncovers new secrets about the origin of the Titans. Tension is rising, alliances are shifting, and no character is guaranteed to survive.',
                'original_price' => 10.00, 'price' => 8.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15,
                'release_date' => '2010-06-09', 'is_on_sale' => true, 'photo1' => 'attack_on_titan_4.JPG',
                'categories' => [$manga->category_id]
            ],
            [
                'name' => 'Attack on Titan vol.5',
                'author' => 'Hajime Isayama',
                'detail' => 'Volume five delivers one of the most emotional moments of the entire series. Sacrifices mount as Eren begins to grasp the true scale of the threat they face. Isayama\'s ability to combine brutal action with deeply human moments is on full display in this unforgettable installment.',
                'original_price' => 10.00, 'price' => 8.00, 'language' => 'EN', 'rating' => 5, 'amount' => 15,
                'release_date' => '2010-09-09', 'is_on_sale' => true, 'photo1' => 'attack_on_titan_5.JPG',
                'categories' => [$manga->category_id]
            ],

            // Detective
            [
                'name' => 'Bestia',
                'author' => 'Dominik Dán',
                'detail' => 'Prvý román zo série o nadporučíkovi Adamovi Dankovi. V Bratislave sa objavuje sériový vrah s nezvyčajným spôsobom konania a Danko dostáva prípad, ktorý ho bude prenasledovať. Dominik Dán, sám bývalý policajt, píše s autenticitou a napätím, ktoré nemá v slovenčine obdobu.',
                'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 12,
                'release_date' => '2010-01-01', 'is_on_sale' => false, 'photo1' => 'dan_bestia.JPG',
                'categories' => [$detective->category_id]
            ],
            [
                'name' => 'Smrť',
                'author' => 'Dominik Dán',
                'detail' => 'Adam Danko sa vracia v ďalšom strhujúcom prípade plnom temných zákutí bratislavského podsvetia. Nová vražda, nové tajomstvá a Danko opäť na hranici zákona aj vlastných síl. Dán potvrdzuje, že slovenská detektívka môže konkurovať tým najlepším svetovým autorom žánru.',
                'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 12,
                'release_date' => '2011-01-01', 'is_on_sale' => false, 'photo1' => 'dan_smrt.JPG',
                'categories' => [$detective->category_id]
            ],
            [
                'name' => 'Krv',
                'author' => 'Dominik Dán',
                'detail' => 'Brutálna vražda odhalí sieť korupcie a zločinu, ktorá siaha oveľa hlbšie, než sa zdá. Tretí diel série o Adamovi Dankovi mieša autentické policajné prostredie s brilantne vykreslenou psychológiou postáv. Čítanie na jeden dych.',
                'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 12,
                'release_date' => '2012-01-01', 'is_on_sale' => false, 'photo1' => 'dan_krv.JPG',
                'categories' => [$detective->category_id]
            ],
            [
                'name' => 'Neodpúšťa',
                'author' => 'Dominik Dán',
                'detail' => 'Danko čelí svojmu možno najnebezpečnejšiemu protivníkovi. Prípad, ktorý sa zdá byť jednoduchý, sa rýchlo mení na osobný súboj so zločincom, ktorý neodpúšťa žiadne chyby. Napínavý a atmosferický román, ktorý drží v napätí až do poslednej strany.',
                'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 12,
                'release_date' => '2013-01-01', 'is_on_sale' => false, 'photo1' => 'dan_neodpusta.JPG',
                'categories' => [$detective->category_id]
            ],
            [
                'name' => 'Hrob',
                'author' => 'Dominik Dán',
                'detail' => 'Objavenie hrobu otvorí staré rany a vyvolá otázky, na ktoré niekto nechce poznať odpovede. Jeden z najtemnejších prípadov v Dankovej kariére preverí nielen jeho schopnosti, ale aj jeho morálku. Dán potvrdzuje svoju pozíciu kráľa slovenského krimi žánru.',
                'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 12,
                'release_date' => '2014-01-01', 'is_on_sale' => false, 'photo1' => 'dan_hrob.JPG',
                'categories' => [$detective->category_id]
            ],
            [
                'name' => 'Pacient',
                'author' => 'Sebastian Fitzek',
                'detail' => 'Psychológ Martin Roth dostane prípad pacienta, ktorý tvrdí, že spácha vraždu — no nevie kedy, kde ani koho. Fitzek, majster psychologického thrilleru, stavia príbeh plný zvratov, kde sa hranica medzi šialenstvom a realitou stráca. Nemožno odložiť, kým neprečítaš poslednú stranu.',
                'price' => 13.50, 'language' => 'SK', 'rating' => 4, 'amount' => 8,
                'release_date' => '2008-01-01', 'is_on_sale' => false, 'is_booktok' => true,
                'photo1' => 'pacient.JPG', 'categories' => [$detective->category_id]
            ],

            // Thriller
            [
                'name' => 'Sám vojak v poli',
                'author' => 'Neznámy',
                'detail' => 'Napínavý thriller o jednotlivcovi, ktorý sa ocitne sám proti systému. Príbeh plný nebezpečenstva, zrady a odhodlania nevzdať sa ani vtedy, keď všetko stojí proti nemu. Čítanie, ktoré vás udrží v napätí od prvej do poslednej strany.',
                'price' => 10.99, 'language' => 'SK', 'rating' => 4, 'amount' => 6,
                'release_date' => '2000-01-01', 'is_on_sale' => false, 'photo1' => 'sam_vojak.JPG',
                'categories' => [$thriller->category_id]
            ],

            // For kids
            [
                'name' => 'Mimi & Líza: Záhrada',
                'author' => 'Katarína Kerekesová',
                'detail' => 'Mimi a Líza objavujú čaro záhrady — sejú semienka, starajú sa o rastliny a učia sa, odkiaľ pochádza jedlo. Krásne ilustrovaná knižka pre najmenších, ktorá nenásilne učí deti o prírode, trpezlivosti a radosti z pestovania. Obľúbená slovenská séria, ktorá baví celé rodiny.',
                'price' => 9.99, 'language' => 'SK', 'rating' => 5, 'amount' => 20,
                'release_date' => '2018-01-01', 'is_on_sale' => false, 'photo1' => 'mimiliza_zahrada.JPG',
                'categories' => [$forkids->category_id]
            ],
            [
                'name' => 'Mimi & Líza: Vianoce',
                'author' => 'Katarína Kerekesová',
                'detail' => 'Mimi a Líza sa tešia na Vianoce a spolu s nimi sa tešiť budú aj najmenší čitatelia. Vianočný diel obľúbenej série prináša atmosféru sviatkov, rodinnej pohody a lásky. Ideálny darček pre deti, ktorý si zamilujú aj rodičia.',
                'price' => 9.99, 'language' => 'SK', 'rating' => 5, 'amount' => 20,
                'release_date' => '2019-01-01', 'is_on_sale' => false, 'photo1' => 'mimiliza_vianoce.JPG',
                'categories' => [$forkids->category_id]
            ],
            [
                'name' => 'Mimi & Líza 2',
                'author' => 'Katarína Kerekesová',
                'detail' => 'Mimi a Líza sa vracajú s novými dobrodružstvami, novými priateľmi a novými lekciami o svete okolo nás. Druhý diel obľúbenej série opäť zaujme krásnou ilustráciou a jednoduchým, ale zmysluplným príbehom pre tie najmenšie deti.',
                'price' => 9.99, 'language' => 'SK', 'rating' => 5, 'amount' => 20,
                'release_date' => '2020-01-01', 'is_on_sale' => false, 'photo1' => 'mimiliza_2.JPG',
                'categories' => [$forkids->category_id]
            ],
            [
                'name' => 'Opica Škorica znovu čaruje',
                'author' => 'Peter Stoličný',
                'detail' => 'Šikovná opica Škorica je späť a opäť čaruje! Plná hravých situácií a veselých ilustrácií, táto knižka rozosmieje každé dieťa. Séria od obľúbeného slovenského autora Petra Stoličného patrí k najčítanejším deťským knihám na Slovensku.',
                'price' => 8.99, 'language' => 'SK', 'rating' => 5, 'amount' => 15,
                'release_date' => '2015-01-01', 'is_on_sale' => false, 'photo1' => 'opica_caruje.JPG',
                'categories' => [$forkids->category_id]
            ],
            [
                'name' => 'Prázdniny s opicou Škoricou',
                'author' => 'Peter Stoličný',
                'detail' => 'Opica Škorica ide na prázdniny a zažíva kopec zábavy a nečakaných situácií. Veselá knižka plná humoru a milých ilustrácií, ktorá sa perfektne hodí na letné čítanie s deťmi. Ďalší skvelý diel obľúbenej série pre najmenších.',
                'price' => 8.99, 'language' => 'SK', 'rating' => 5, 'amount' => 15,
                'release_date' => '2016-01-01', 'is_on_sale' => false, 'photo1' => 'opica_prazdniny.JPG',
                'categories' => [$forkids->category_id]
            ],
            [
                'name' => 'Vianoce s opicou Škoricou',
                'author' => 'Peter Stoličný',
                'detail' => 'Opica Škorica sa teší na Vianoce a chystá prekvapenia pre všetkých okolo. Vianočný diel obľúbenej série prináša teplo sviatkov, dobré skutky a veľa smiechu. Krásny darček pre každé dieťa pod stromček.',
                'price' => 8.99, 'language' => 'SK', 'rating' => 5, 'amount' => 15,
                'release_date' => '2017-01-01', 'is_on_sale' => false, 'photo1' => 'opica_vianoce.JPG',
                'categories' => [$forkids->category_id]
            ],

            // Cooking
            [
                'name' => 'Pečenie pre deti',
                'author' => 'Mladé letá',
                'detail' => 'Zábavná kuchárska kniha plná jednoduchých receptov, ktoré zvládnu aj deti. Od sušienok po koláče — každý recept je podrobne vysvetlený s farebnými obrázkami. Ideálna pre rodiny, ktoré chcú tráviť čas v kuchyni spolu a vytvárať sladké spomienky.',
                'price' => 12.99, 'language' => 'SK', 'rating' => 4, 'amount' => 10,
                'release_date' => '2015-01-01', 'is_on_sale' => false, 'photo1' => 'pecenie_pre_deti.JPG',
                'categories' => [$cooking->category_id]
            ],
            [
                'name' => 'Pečieme s Jožkou',
                'author' => 'Jozefína Zaukovolcová',
                'detail' => 'Jožka vás zavedie do svojej kuchyne plnej vône čerstvo upečeného chleba, koláčov a sladkostí. Recepty sú jednoduché, prístupné a overené — ideálne pre každého, kto chce začať piecť alebo rozšíriť svoj repertoár. Slovenská kuchárka s dušou a tepom domova.',
                'price' => 13.99, 'language' => 'SK', 'rating' => 4, 'amount' => 8,
                'release_date' => '2018-01-01', 'is_on_sale' => false, 'photo1' => 'pecieme_s_jozkou.JPG',
                'categories' => [$cooking->category_id]
            ],
            [
                'name' => 'Talianska kuchárka',
                'author' => 'Bo Hagstrom',
                'detail' => 'Výprava do srdca talianskej kuchyne — od klasickej pasty a pizze až po regionálne špeciality, ktoré sa bežne nevaria mimo Talianska. Každý recept je sprevádzaný krásnymi fotografiami a príbehom o jeho pôvode. Pre všetkých milovníkov talianskej kultúry a dobrého jedla.',
                'price' => 18.99, 'language' => 'SK', 'rating' => 4, 'amount' => 7,
                'release_date' => '2016-01-01', 'is_on_sale' => false, 'photo1' => 'talianska_kucharka.JPG',
                'categories' => [$cooking->category_id]
            ],

            // Historical
            [
                'name' => 'Posledný Žid z Treblinky',
                'author' => 'Chil Reichman',
                'detail' => 'Chil Reichman bol jedným z mála preživších vyhladzovacieho tábora Treblinka. Toto je jeho svedectvo — surové, bolestivé a nesmierne dôležité. Príbeh, ktorý neslobodno zabudnúť, o ľudskej krutosti, ale aj o neuvierateľnej sile vôle prežiť.',
                'original_price' => 15.99, 'price' => 12.99, 'language' => 'SK', 'rating' => 5, 'amount' => 8,
                'release_date' => '2006-01-01', 'is_on_sale' => true, 'photo1' => 'posledny_zid.JPG',
                'categories' => [$historical->category_id]
            ],
            [
                'name' => 'Prežil aby odriekal kadiš',
                'author' => 'Romi Cohn & Leonard Ciacio',
                'detail' => 'Skutočný príbeh Romiho Cohna — chlapca z bratislavskej ortodoxnej rodiny, ktorý prežil holokaust vďaka neuveriteľnej odvahe a šťastiu. Dojemná spomienková kniha, ktorá vzdáva hold všetkým, ktorí neprežili, a pripomína dôležitosť pamäti a odovzdávania svedectiev ďalším generáciám.',
                'price' => 12.99, 'language' => 'SK', 'rating' => 5, 'amount' => 6,
                'release_date' => '2008-01-01', 'is_on_sale' => false, 'photo1' => 'prezil.JPG',
                'categories' => [$historical->category_id]
            ],
            [
                'name' => 'Sestrin sľub',
                'author' => 'Rena Kornreich Gelissen',
                'detail' => 'Rena Kornreich bola jednou z prvých žien deportovaných do Osvienčimu. Prežila vďaka sľubu, ktorý dala sestre — že sa o ňu postará za každých okolností. Silný a hlboko ľudský príbeh o sile súrodeneckej lásky a odhodlaní prežiť aj v tých najhorších podmienkach.',
                'price' => 11.99, 'language' => 'SK', 'rating' => 5, 'amount' => 7,
                'release_date' => '2007-01-01', 'is_on_sale' => false, 'photo1' => 'sestrin_slub.JPG',
                'categories' => [$historical->category_id]
            ],
            [
                'name' => 'Vojenské omyly druhej svetovej vojny',
                'author' => 'Kenneth Macksey',
                'detail' => 'Analytický pohľad na najväčšie strategické a taktické chyby druhej svetovej vojny — od Hitlerovho napadnutia Sovietskeho zväzu až po rozhodnutia spojencov. Macksey skúma, ako iné rozhodnutia mohli zmeniť priebeh vojny, a prináša fascinujúci pohľad na vojenskú históriu.',
                'price' => 15.99, 'language' => 'SK', 'rating' => 4, 'amount' => 5,
                'release_date' => '2005-01-01', 'is_on_sale' => false, 'photo1' => 'vojenske_omyly.JPG',
                'categories' => [$historical->category_id]
            ],

            // Encyclopedia
            [
                'name' => 'Školská encyklopédia',
                'author' => 'Mladé letá',
                'detail' => 'Komplexná encyklopédia určená školákom, ktorá pokrýva témy od prírodovedy a histórie až po geografi a kultúru. Prehľadne usporiadaná, bohatá na ilustrácie a mapy. Nenahraditeľný pomocník pri učení aj pri uspokojovaní detskej zvedavosti.',
                'price' => 19.99, 'language' => 'SK', 'rating' => 4, 'amount' => 10,
                'release_date' => '2010-01-01', 'is_on_sale' => false, 'photo1' => 'skolska_encyklopedia.JPG',
                'categories' => [$encyclo->category_id]
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
