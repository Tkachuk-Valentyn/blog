<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'show posts']);
        Permission::create(['name' => 'add posts']);
        Permission::create(['name' => 'edit posts']);
        Permission::create(['name' => 'delete posts']);
        Permission::create(['name' => 'show comments']);
        Permission::create(['name' => 'add comments']);
        Permission::create(['name' => 'edit comments']);
        Permission::create(['name' => 'delete comments']);
        Permission::create(['name' => 'edit self comments']);
        Permission::create(['name' => 'delete self comments']);
    }
}
