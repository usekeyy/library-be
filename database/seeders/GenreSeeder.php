<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genre = [
            [
                'genre_name'      => 'Akutansi', 
            ],
            [
                'genre_name'      => 'Comedy', 
            ],            
            [
                'genre_name'      => 'Horor', 
            ],            
            
        ];

        foreach($genre as $key=>$item){
            Genre::create($item);
        }
    }
}
