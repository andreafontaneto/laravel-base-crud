<?php

use App\Comic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ComicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_comics = config('comics');

        // dump($array_comics);

        foreach ($array_comics as $comic) {
            
            $new_comic = new Comic();

            $new_comic->title = $comic['title'];
            $new_comic->slug = Str::slug($new_comic->title, '-');
            // dd($new_comic->slug);
            $new_comic->description = $comic['description'];
            $new_comic->image = $comic['thumb'];
            $new_comic->price = $comic['price'];
            $new_comic->series = $comic['series'];
            $new_comic->sales_date = $comic['sale_date'];
            $new_comic->type = $comic['type'];

            $new_comic->save();

        }
    }
}
