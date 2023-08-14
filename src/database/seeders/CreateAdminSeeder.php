<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'email' => 'admin1@gmail.com',
            'name' => 'Admin1',
            'password' => 'admin'
        ]);

        $adminRole = Role::create([
            'name' => 'admin'
        ]);

        $admin->assignRole($adminRole['name']);

        $adminRole->givePermissionTo(['show posts',
            'add posts',
            'edit posts',
            'delete posts',
            'show comments',
            'add comments',
            'edit comments',
            'delete comments']);

    }
}
