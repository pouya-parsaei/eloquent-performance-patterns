<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Checkout;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Device;
use App\Models\Feature;
use App\Models\Post;
use App\Models\Region;
use App\Models\Store;
use App\Models\Vote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        $features = Feature::factory(100)->create();
//        foreach ($features as $feature) {
//            Comment::factory(random_int(10, 30))->for($feature)->create();
//            Vote::factory(random_int(10, 30))->for($feature)->create();
//        }
//        Company::factory(100)->has(User::factory(50))->create();
//        Profile::factory(100)->create();
//        Customer::factory(1000)->create();
//        $books = Book::factory(100)->create();
//        $books->map(function($book){
//           Checkout::factory(100)->create([
//               'book_id'=>$book->id
//           ]);
//        });
//        for ($i = 0; $i <= 11; $i++) {
//            Device::factory()->create([
//                'name' => 'Apple ' . $i,
//                'brand' => 'Apple'
//            ]);
//        }

//        Post::factory(500)->create();
//        Post::find(5)->update([
//            'title' => 'Information about foxes from wikipedia.',
//            'body' => 'Foxes are small to medium-sized, omnivorous mammals belonging to several genera of the family Canidae. Foxes have a flattened skull, upright triangular ears, a pointed, slightly upturned snout, and a long bushy tail (or brush).',
//        ]);
//
//        Post::find(10)->update([
//            'title' => 'A sentence that contains all of the letters of the alphabet.',
//            'body' => 'The quick brown fox jumps over the lazy dog.',
//        ]);
//
//        Post::find(15)->update([
//            'title' => 'Fox and the Hound',
//            'body' => "Copper, you're my very best friend.\n\nAnd you're mine too, Tod.\n\nAnd we'll always be friends forever, won't we?\n\nYeah. Forever.",
//        ]);

//        Store::factory(450)->create();

        $this->seedRegions();
        $this->seedCustomers();
    }

    public function getRegions()
    {
        return collect([
            [
                'name' => 'British Columbia',
                'color' => '#F56565',
                'geometry' => 'MultiPolygon (((-136.21070809681475566 57.03101434136195991, -133.72877891703720366 54.61201637520210284, -133.47202762257742847 53.45604439614419334, -131.01862636440651499 51.6878513109907729, -126.28299137770447658 48.97546429328855311, -125.05629074861900563 48.48622934024960074, -123.37102414358200519 48.11059520996249717, -122.52069777133300477 48.99007009784259736, -113.96448759224449532 48.98897113447335272, -114.59407626641420563 50.4166998690063437, -119.86365984910806048 53.47639943303917676, -119.94099441499190561 59.97238022147455894, -140.92938615814153991 60.06202748779399059, -140.74999819452486349 59.61135341849296054, -138.11897472814712273 58.90840120048653006, -136.21070809681475566 57.03101434136195991)))',
            ], [
                'name' => 'The Prairies',
                'color' => '#ED64A6',
                'geometry' => 'MultiPolygon (((-119.94099441499190561 60.00228965918908131, -119.86342785805500455 53.47769838616169835, -114.59813892172027749 50.42187702898244339, -113.96428865057700364 48.99007009784259736, -95.14655752770366348 48.9943115615749889, -95.11913369861004242 52.95562365987785114, -88.96631066049427261 56.8362663437242901, -90.88014430909245789 57.32962729256960444, -92.13586005440910753 57.1678816249715851, -92.91320789674797709 58.72262921391369161, -94.4679035814257162 58.97010425293494507, -94.94627148440348208 59.97238022147455894, -119.94099441499190561 60.00228965918908131)))',
            ], [
                'name' => 'Northern Ontario',
                'color' => '#ED8936',
                'geometry' => 'MultiPolygon (((-95.14655752770366348 48.68340047507278712, -91.49871251207848388 48.02653818561485366, -89.48299783571330579 47.9273562080065787, -88.33320051750560253 48.27878552072419893, -85.15107328402109488 46.81933528509360087, -83.56516177500490983 45.80882881550991925, -82.48341642661449669 45.32591884323021247, -75.57326736666500722 45.31431204836569293, -75.57326736666500722 45.47597301709868844, -78.55466133182321187 46.60067106413608684, -79.53817622480349314 47.59040751811833303, -79.49541470771738716 49.43147955366239188, -79.47403394917432706 51.51302555186973819, -81.09897159844608439 51.98952742880787525, -82.10386724996939734 53.36350808871527818, -82.41734986013378261 55.1210655381972856, -85.35234985013660491 55.5074593250587327, -88.96634237514010124 56.83638319607099021, -95.12237584795525436 52.95536207790076588, -95.14655752770366348 48.68340047507278712)))',
            ], [
                'name' => 'Southern Ontario',
                'color' => '#38B2AC',
                'geometry' => 'MultiPolygon (((-82.12227870904746396 43.57609569265800076, -83.05933083665699712 42.30857452806961305, -83.15971983981076221 41.88647200328418307, -82.40680231615748141 41.66186912772772644, -81.26906028041477725 42.18471840781833748, -80.08112374309519055 42.37041138732155332, -78.90991870630122662 42.86291588481849857, -78.66996263907869036 43.62388065210076604, -76.77183987706929713 43.60555757532381449, -76.24036550370665566 44.19819894447277164, -75.58234961287672604 44.60503227270204718, -75.57326736666500722 45.31431204836569293, -82.5138046676586896 45.33101943381030452, -82.12227870904746396 43.57609569265800076)))',
            ], [
                'name' => 'Quebec & The Maritimes',
                'color' => '#4299E1',
                'geometry' => 'MultiPolygon (((-62.68165341449829953 59.38008830926620618, -55.78932107235463178 54.48169328792566546, -51.65392166706843113 46.6236839403112171, -65.50422761175713049 43.18475171644517729, -67.79938458774800836 45.64784574060350053, -67.7378341919936986 47.070742156101673, -68.98321441302965695 47.11731081056817771, -70.09911583985291372 46.03445019262699844, -71.49814235947626173 44.99411331934209102, -74.752763330533881 44.96909045661329429, -75.57526265202399429 44.61132802011519516, -75.56912673251970602 45.47647375519564861, -78.52179594672490737 46.58252010687859013, -79.54829188305301102 47.58104432537199102, -79.45053036530750035 51.52610385436022256, -79.55145733764994986 54.67192485590015139, -76.46631809878563502 56.52580969031615865, -78.69812095243216277 58.63653152782740108, -78.07207644900944388 59.61254191892073351, -77.68169995812947093 60.55706225654519415, -78.75162071091159532 60.69889250372828116, -78.02870128335611355 61.21826344634690287, -78.39016099713386154 62.67976394677150154, -75.79218511266628866 62.40356941050374928, -73.60755034166176358 62.46224468760436821, -69.46259597703266309 61.01719256353432996, -69.36506763904137074 59.27476503331250512, -67.59980472139933738 58.25324293660128916, -66.5757571724909667 58.72727910983149258, -65.74676629956513807 59.63165063192824533, -64.66420174786202324 60.83235410175940672, -62.68165341449829953 59.38008830926620618)))',
            ],
        ]);
    }

    protected function seedRegions()
    {
        $this->getRegions()->each(function ($region) {
            return Region::create([
                'name' => $region['name'],
                'color' => $region['color'],
                'geometry' => (function () use ($region) {
                    if (config('database.default') === 'mysql') {
                        return DB::raw("ST_SRID(ST_GeomFromText('" . $region['geometry'] . "'), 4326)");
                    }

                    if (config('database.default') === 'sqlite') {
                        throw new \Exception('This lesson does not support SQLite.');
                    }

                    if (config('database.default') === 'pgsql') {
                        return DB::raw("ST_SetSRID(ST_GeomFromText('" . $region['geometry'] . "'), 4326)");
                    }
                })(),
            ]);
        });
    }

    protected function seedCustomers()
    {
        collect(array_map('str_getcsv', file(__DIR__.'/stores.csv')))
            ->filter(function ($store) {
                return in_array($store[2], ['AB', 'BC', 'MB', 'NB', 'NL', 'NS', 'NT', 'NU', 'ON', 'PE', 'QC', 'SK', 'YT']);
            })
            ->groupBy(function ($store) {
                return $store[2];
            })
            ->flatMap(function ($stores) {
                return $stores->count() > 50 ? $stores->random(50) : $stores;
            })
            ->each(function ($store) {
                return Customer::factory()->create(['location' => (function () use ($store) {
                    if (config('database.default') === 'mysql') {
                        return DB::raw('ST_SRID(Point(' . $store[4] . ', ' . $store[3] . '), 4326)');
                    }

                    if (config('database.default') === 'sqlite') {
                        throw new \Exception('This lesson does not support SQLite.');
                    }

                    if (config('database.default') === 'pgsql') {
                        return DB::raw('ST_SetSRID(ST_MakePoint(' . $store[4] . ', ' . $store[3] . '), 4326)');
                    }
                })()]);
            });
    }
}
