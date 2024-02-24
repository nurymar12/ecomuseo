<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tour;
use App\Models\Components;

class ToursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un tour
        $tour = Tour::create([
            'name' => 'Tour del Ecomuseo',
            'description' => 'Un recorrido fascinante por el ecomuseo.',
            'max_people' => 20,
            'start_date' => now()->addDays(10),
            'end_date' => now()->addDays(11),
            'contact_info' => '945291643'
        ]);

        // Suponiendo que ya tienes componentes creados y quieres relacionarlos con este tour
        $componentesIds = Components::pluck('id')->take(3); // Ajusta según sea necesario
        $tour->components()->attach($componentesIds);
    }
}
