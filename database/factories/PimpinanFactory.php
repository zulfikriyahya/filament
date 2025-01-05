<?php

namespace Database\Factories;

use App\Models\Pimpinan;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PimpinanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pimpinan::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'nip' => $this->faker->word(),
            'ttd' => $this->faker->word(),
            'foto' => $this->faker->word(),
            'periode_awal' => $this->faker->date(),
            'periode_akhir' => $this->faker->date(),
            'status' => $this->faker->boolean(),
        ];
    }
}
