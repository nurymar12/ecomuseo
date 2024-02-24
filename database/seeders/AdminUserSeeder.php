<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $superAdmin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678')
        ]);
        $superAdmin->assignRole('Super Admin');

        $visitor = User::create([
            'name' => 'no_admin',
            'email' => 'no-admin@no-admin.com',
            'password' => Hash::make('12345678')
        ]);
        $visitor->assignRole('Visitor');

        $volunteer = User::create([
            'name' => 'voluntario',
            'email' => 'voluntario@voluntario.com',
            'password' => Hash::make('12345678')
        ]);
        $volunteer->assignRole('Volunteer');

    }
}
