<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'admin',
            'username' => 'admin',
            'password' => app('hash')->make('admin'),
        ];
        $model = User::create($data);
        $model->assignRole('admin');

        $data = [
            'name' => 'user',
            'username' => 'user',
            'password' => app('hash')->make('user'),
        ];
        $model = User::create($data);
        $model->assignRole('user');
    }
}
