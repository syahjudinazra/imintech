<?php

namespace Database\Factories;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Barang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'serialnumber' => $this->faker->serialnumber,
            'pelanggan' => $this->faker->pelanggan,
            'model' => $this->faker->model,
            'kerusakan' => $this->faker->kerusakan,
            'kerusakanbawaan' => $this->faker->kerusakanbawaan,
            'teknisi' => $this->faker->teknisi,
            'perbaikan' => $this->faker->perbaikan,
            'snkanibal' => $this->faker->snkanibal,
            'nosparepart' => $this->faker->nosparepart,
        ];
    }
}
