<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Instansi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Negara;
use App\Models\Pimpinan;
use App\Models\Provinsi;

class InstansiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Instansi::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'nss' => $this->faker->word(),
            'npsn' => $this->faker->word(),
            'logo' => $this->faker->word(),
            'telepon' => $this->faker->word(),
            'email' => $this->faker->safeEmail(),
            'website' => $this->faker->word(),
            'no_sk_pendirian' => $this->faker->word(),
            'tanggal_pendirian' => $this->faker->date(),
            'pimpinan_id' => Pimpinan::factory(),
            'alamat' => $this->faker->word(),
            'negara_id' => Negara::factory(),
            'provinsi_id' => Provinsi::factory(),
            'kabupaten_id' => Kabupaten::factory(),
            'kecamatan_id' => Kecamatan::factory(),
            'kelurahan_id' => Kelurahan::factory(),
        ];
    }
}
