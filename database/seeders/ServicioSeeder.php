<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        $servicios = [
            [
                'nombre' => 'Corte de Cabello',
                'descripcion' => 'Corte profesional con técnicas modernas y acabado perfecto',
                'precio' => 25.00,
                'imagen' => 'corte.jpg',
            ],
            [
                'nombre' => 'Arreglo de Barba',
                'descripcion' => 'Afeitado clásico con navaja y cuidado de barba',
                'precio' => 18.00,
                'imagen' => 'barba.jpg',
            ],
            [
                'nombre' => 'Corte + Barba',
                'descripcion' => 'Combo completo de corte de cabello y arreglo de barba',
                'precio' => 38.00,
                'imagen' => 'combo.jpg',
            ],
            [
                'nombre' => 'Coloración',
                'descripcion' => 'Tinte profesional y aplicación de color de calidad',
                'precio' => 45.00,
                'imagen' => 'color.jpg',
            ],
            [
                'nombre' => 'Tratamiento Capilar',
                'descripcion' => 'Hidratación y tratamiento revitalizante para el cabello',
                'precio' => 30.00,
                'imagen' => 'tratamiento.jpg',
            ]
        ];

        foreach ($servicios as $servicio) {
            Servicio::create($servicio);
        }
    }
}
