<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            [
                'name'      => 'Sistem Akuntansi Sektor Publik', 
                'genre_id'  => '1',
                'tahun'     =>  2010,
                'deskripsi' => 'Buku ini bercerita tentang',
                'penerbit'  => 'Bastian, Indra',
            ],
            [
                'name'      => 'Strategi menyiasati pemeriksaan pada lembaga negara, pemerintah, BUMN/BUMD', 
                'genre_id'  => '1',
                'tahun'     =>  2012,
                'deskripsi' => 'Buku ini bercerita tentang',
                'penerbit'  => 'Sumadjo',
            ],            
            [
                'name'      => 'Introduction to govermental and not for profit accounting', 
                'genre_id'  => '1',
                'tahun'     =>  2013,
                'deskripsi' => 'Buku ini bercerita tentang',
                'penerbit'  => 'Martin Ives dkk',
            ],            
            [
                'name'      => 'Ubur-Ubur Lembur', 
                'genre_id'  => '2',
                'tahun'     =>  2018,
                'deskripsi' => 'Buku ini bercerita tentang',
                'penerbit'  => 'Raditya Dika',
            ],
            [
                'name'      => 'Setengah Jalan', 
                'genre_id'  => '2',
                'tahun'     =>  2019,
                'deskripsi' => 'Buku ini bercerita tentang',
                'penerbit'  => 'Ernest Prakasa',
            ],
            [
                'name'      => 'The Devil All the Time', 
                'genre_id'  => '3',
                'tahun'     =>  2022,
                'deskripsi' => 'Buku ini bercerita tentang',
                'penerbit'  => 'Donald Ray Pollock',
            ],
            [
                'name'      => 'Misteri Organisasi Rahasia The Jugdes', 
                'genre_id'  => '3',
                'tahun'     =>  2022,
                'deskripsi' => 'Buku ini bercerita tentang',
                'penerbit'  => 'Lexie Xu',
            ],
            
        ];

        foreach($books as $key=>$item){
            Book::updateOrCreate(['name' => $item['name']], $item);
        }

    }
}
