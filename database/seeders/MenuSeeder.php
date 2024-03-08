<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create(
            [
                'name'          => 'Master Book',
                'permission_id' => 1,
                'url'           => '/master/book',
            ],
            [
                'name'          => 'Genre Book',
                'permission_id' => 1,
                'url'           => '/master/genre',
            ],
            [
                'name'          => 'Transaction Book',
                'permission_id' => 1,
                'url'           => '/transaction/book',
            ],
        );
    }
}
