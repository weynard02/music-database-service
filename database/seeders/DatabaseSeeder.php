<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ArtistSeeder::class,
            SongSeeder::class,
        ]); 

        
    }
    
    User: :create([
        'name' => 'Akhmad Mustofa Solikin',
        'Nrp' => '502521130',
    ])

    User: :create([
        'name' => 'Alexander Weynard Samsico',
        'Nrp' => '5025211014',
    ])            
            
    Category: :create([
        'name' => 'Music',
        'slug' => 'musik'
     ]);    

    Category: :create([
        'title' => 'Music',
        'slug' => 'music'
        'excerpt' => 'Musik adalah cabang seni yang membahas dan menetapkan berbagai suara ke dalam pola-pola yang dapat dimengerti dan dipahami manusia. Musik telah menjadi bagian dari kehidupan manusia sehari-hari. Bahkan, ada orang-orang yang menjadikan musik sebagai kebutuhan hidup. Dirinya baru bisa berfungsi dengan baik apabila beraktivitas sambil mendengarkan musik.',
        'body' => 'Musik adalah cabang seni yang membahas dan menetapkan berbagai suara ke dalam pola-pola yang dapat dimengerti dan dipahami manusia. Musik telah menjadi bagian dari kehidupan manusia sehari-hari. Bahkan, ada orang-orang yang menjadikan musik sebagai kebutuhan hidup. Dirinya baru bisa berfungsi dengan baik apabila beraktivitas sambil mendengarkan musik.
                    Seiring waktu, musik juga mengalami perkembangan dalam hal jenis dan genre. Anda kini mengenal jenis musik pop, rock, blues, indie, metal, dan sebagainya sebagai bagian dari jenis-jenis musik yang beredar di masyarakat. Sangat menarik membahas tentang pengertian musik dan juga unsur-unsurnya. Berikut ulasan selengkapnya, yang patut Anda baca lebih lanjut.',
        'category_id' => 1,
        'user_id' => 1
         ]);   
}
