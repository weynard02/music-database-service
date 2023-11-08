<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = array("pop", "jazz", "hiphop", "rock", "classic", "acoustic", "live", "kpop", "jpop", "indie", "sleep", "party", "love", "metal", "anime", "podcast", "gaming");
        $len = count($genres);
        for($i=0;$i<$len;$i++) {
            Genre::create([
                'name' => $genres[$i],
            ]);
        }
    }
}
