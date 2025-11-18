<?php

namespace Database\Factories;

use App\Models\Aeronave;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aeronave>
 */
class AeronaveFactory extends Factory
{
    protected $model = Aeronave::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'matricula' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'tipo' => $this->faker->randomElement(['ala fija', 'ala rotatoria']),
            'modelo' => $this->faker->word(),
            'marca' => $this->faker->randomElement(['Cessna', 'Piper', 'Beechcraft']),
            'numero_serie' => $this->faker->unique()->numerify('SN-#####'),
            'numero_parte' => $this->faker->unique()->numerify('PN-#####'),
            'fabricante_id' => null, // Ajusta según tu lógica
            'estado' => $this->faker->randomElement(['activo', 'mantenimiento', 'inactivo']),
            'hangar_id' => null, // Ajusta según tu lógica
            'ubicacion_actual' => $this->faker->city(),
            'documento_legal' => null,
            'documento' => null,
            'horas_vuelo_total' => $this->faker->randomFloat(1, 0, 5000),
            'horas_desde_mantenimiento' => $this->faker->randomFloat(1, 0, 50),
            'mantenimiento_cada_horas' => 50,
            'fecha_ultimo_mantenimiento' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
