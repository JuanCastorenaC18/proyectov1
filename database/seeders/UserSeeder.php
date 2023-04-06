<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'UserAdmin',
            'email' => 'juancruzcastorena18@gmail.com',
            'password' => Hash::make('Juan1812'),
            'remember_token' => '',
        ])->assignRole('Admin');

        User::create([
            'name' => 'UserSupervisor',
            'email' => 'juancruzcastorena1812@gmail.com',
            'password' => Hash::make('Juan1812'),
            'remember_token' => '',
        ])->assignRole('Supervisor');

        User::create([
            'name' => 'UserClient',
            'email' => 'jjdelacrwz09@gmail.com',
            'password' => Hash::make('Juan1812'),
            'remember_token' => '',
        ])->assignRole('Client');
    }
}
