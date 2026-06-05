<?php

namespace Database\Factories;

use App\Models\Entrada;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Entrada>
 */
class EntradaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->lexify(str_repeat('?', 50)),
            'tag' => $this->faker->word(),
            'imagen' => $this->faker->word(),
            'contenido' => $this->faker->paragraph(),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
