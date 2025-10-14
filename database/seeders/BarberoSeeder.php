<?php

namespace Database\Seeders;

use App\Models\Barbero;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BarberoSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $barberos = [
            [
                'user' => [
                    'name' => 'Carlos',
                    'email' => 'carlos@barberia.com',
                    'password' => Hash::make('123456'),
                    'role' => 'barbero',
                ],
                'barbero' => [
                    'nombre' => 'Carlos',
                    'apellido' => 'Rodríguez',
                    'especialidad' => 'Cortes clásicos y barbas',
                ]
            ],
            [
                'user' => [
                    'name' => 'Miguel',
                    'email' => 'miguel@barberia.com',
                    'password' => Hash::make('123456'),
                    'role' => 'barbero',
                ],
                'barbero' => [
                    'nombre' => 'Miguel',
                    'apellido' => 'Santos',
                    'especialidad' => 'Fade modernos y diseños',
                ]
            ],
        ];

        foreach ($barberos as $barbero) {
            // Crear usuario
            $user = User::create($barbero['user']);

            // Crear barbero relacionado
            Barbero::create([
                'user_id' => $user->id,
                ...$barbero['barbero']
            ]);
        }
    }
    // Barbero::factory(10)->create();
}
