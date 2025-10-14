<?php

namespace Database\Seeders;

use App\Models\Barbero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarberoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  Barbero::factory()->create([
        // 'nombre'=>'Juan',
        // 'apellido'=>'Nina',
        // 'email'=>'Juan@gmail.com',
        // 'especialidad'=>'Degrade',
            
        // ]);
        Barbero::factory(10)->create(); // 👈 Esto ya funcionará
    }
}
