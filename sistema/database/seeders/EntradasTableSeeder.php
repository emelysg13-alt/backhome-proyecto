<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Entrada;
use Illuminate\Database\Seeder;
class EntradasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    /*
        Entrada::create([
            'user_id' => 1,
            'titulo' => 'Primer Título',
            'imagen' => 'imagen1.jpg',
            'tag' => 'Etiqueta 1',
            'contenido' => 'Contenido de la entrada 1',
           
        ]);

        Entrada::create([
            'user_id' => 1,
            'titulo' => 'Segundo Título',
            'imagen' => 'imagen2.jpg',
            'tag' => 'Etiqueta 2',
            'contenido' => 'Contenido de la entrada 2',
           
        ]);

        */

        Entrada::factory()->count(100)->create();
    }
}
