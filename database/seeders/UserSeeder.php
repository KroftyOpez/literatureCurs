<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $role_admin = Role::where('code', 'admin')->first();
        $role_user = Role::where('code', 'user')->first();

        User::create([
            'email' => 'admin@gmail.com',
            'nickname' => 'admin',
            'birth' => '2000-01-01',
            'role_id' => $role_admin->id,
            'password' => 'mewmew',
            'token' => '1'
        ]);
        User::create([
            'email' => 'user@gmail.com',
            'nickname' => 'user',
            'birth' => '2000-01-02',
            'role_id' => $role_user->id,
            'password' => 'mewmew2',
            'token' => '2'
        ]);

    }
}
