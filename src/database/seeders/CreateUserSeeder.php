<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = User::create([
            'email' => 'user1@gmail.com',
            'name' => 'User1',
            'password' => 'password'
        ]);

        Role::create([
            'name' => 'user'
        ]);

        $userRole->assignRole('user');

        $userRole->givePermissionTo(['show posts', 'show comments', 'edit self comments', 'delete self comments']);
    }
}
