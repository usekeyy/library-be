<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['permission' => ['name' => 'create book', 'guard_name' => 'api']],
            ['permission' => ['name' => 'view book', 'guard_name' => 'api']],
            ['permission' => ['name' => 'update book', 'guard_name' => 'api']],
            ['permission' => ['name' => 'delete book', 'guard_name' => 'api']],
            ['permission' => ['name' => 'create role', 'guard_name' => 'api']],
        ];
        foreach ($data as $value) {
            $model = Permission::create($value['permission']);
        }
    }
}
