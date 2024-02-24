<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class componentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('components')->insert([
            'titleComponente' => 'Abejas Meliponas',
            'description' => '¿Quieres A Ver Las Abejas Meliponas? Descubre Todo Lo Que Tenemos Preparado Para Ti.',
            'contentComponente' => '',
            'rutaImagenComponente' => 'images/componentes/abejas_meliponas.jpg',
        ]);
        DB::table('components')->insert([
            'titleComponente' => 'Huayruro',
            'description' => 'Realiza Una Busqueda En El Bosque Para Encontrar Los Arboles De Huayruro',
            'contentComponente' => '',
            'rutaImagenComponente' => 'images/componentes/huayruro.jpg',
        ]);
        DB::table('components')->insert([
            'titleComponente' => 'Cashaponas',
            'description' => 'Con Sus Grandes Ramas Que Parecen Piernas. Ven Y Descubre Mas De Ellas.',
            'contentComponente' => '',
            'rutaImagenComponente' => 'images/componentes/cashapona.jpg',
        ]);
        DB::table('components')->insert([
            'titleComponente' => 'Interpretacion',
            'description' => 'Aprendamos Como Cuidar La Naturaleza Que Nos Rodea',
            'contentComponente' => '',
            'rutaImagenComponente' => 'images/componentes/interpretación.jpg',
        ]);
    }
}
