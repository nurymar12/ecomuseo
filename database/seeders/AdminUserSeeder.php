<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'), // Asegúrate de que usas Hash para encriptar la contraseña
        ]);

        // Nuevo usuario
        DB::table('users')->insert([
            'name' => 'no_admin',
            'email' => 'no-admin@no-admin.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
