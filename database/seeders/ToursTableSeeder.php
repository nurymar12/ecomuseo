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

        $toursData = [
            [
                'name' => 'Ruta del Huayruro: Tesoros de la Selva',
                'description' => 'Un viaje que explora la historia, significado cultural y usos del emblemático Huayruro en la Amazonía.',
                'max_people' => 20,
                'start_date' => now()->addDays(10),
                'end_date' => now()->addDays(11),
                'contact_info' => '945291643',
                'components' => [2], // IDs de los componentes para este tour
            ],
            [
                'name' => 'El Zumbido Secreto: El Mundo de las Abejas Meliponas',
                'description' => 'Este tour invita a los visitantes a sumergirse en el mundo de las abejas sin aguijón, descubriendo su importancia en la polinización y la producción de miel única.',
                'max_people' => 15,
                'start_date' => now()->addDays(20),
                'end_date' => now()->addDays(22),
                'contact_info' => '912345678',
                'components' => [1], // IDs de los componentes para este tour
            ],
            [
                'name' => 'Gigantes Verdes: El Legado de las Cashaponas',
                'description' => 'Un recorrido que destaca la majestuosidad de los árboles Cashapona, su rol en el ecosistema y los esfuerzos por su conservación.',
                'max_people' => 20,
                'start_date' => now()->addDays(10),
                'end_date' => now()->addDays(11),
                'contact_info' => '945291643',
                'components' => [3], // IDs de los componentes para este tour
            ],
            [
                'name' => 'Sinfonía de la Selva: Huayruro, Meliponas y Cashaponas',
                'description' => 'Una experiencia integral que fusiona la magia del Huayruro, el mundo fascinante de las Abejas Meliponas y la grandeza de las Cashaponas, ofreciendo una visión completa de la biodiversidad amazónica.',
                'max_people' => 15,
                'start_date' => now()->addDays(20),
                'end_date' => now()->addDays(22),
                'contact_info' => '912345678',
                'components' => [1, 2, 3], // IDs de los componentes para este tour
            ],
            [
                'name' => 'Alas y Raíces: Polinizadores y Protectores del Amazonas',
                'description' => 'Este tour combina la exploración de las Abejas Meliponas con el conocimiento sobre los árboles Cashapona, enfatizando su interdependencia y su papel vital en el mantenimiento de los ecosistemas.',
                'max_people' => 20,
                'start_date' => now()->addDays(10),
                'end_date' => now()->addDays(11),
                'contact_info' => '945291643',
                'components' => [1, 3], // IDs de los componentes para este tour
            ],
            [
                'name' => 'Voces de la Selva: Guardianes de la Biodiversidad',
                'description' => 'Un recorrido que celebra a los guardianes naturales de la Amazonía, desde las semillas que atraen la suerte hasta las abejas que susurran entre flores y los árboles que sostienen el cielo.',
                'max_people' => 15,
                'start_date' => now()->addDays(20),
                'end_date' => now()->addDays(22),
                'contact_info' => '912345678',
                'components' => [1, 2], // IDs de los componentes para este tour
            ],
            // Puedes agregar más tours aquí
        ];

        foreach ($toursData as $tourData) {
            // Crear el tour
            $tour = Tour::create([
                'name' => $tourData['name'],
                'description' => $tourData['description'],
                'max_people' => $tourData['max_people'],
                'start_date' => $tourData['start_date'],
                'end_date' => $tourData['end_date'],
                'contact_info' => $tourData['contact_info'],
            ]);

            // Relacionar los componentes específicos con el tour creado
            $tour->components()->attach($tourData['components']);
        }
    }
}
