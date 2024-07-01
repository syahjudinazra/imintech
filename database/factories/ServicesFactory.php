<?php

namespace Database\Factories;

use App\Models\Services;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServicesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Services::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tanggalmasuk = $this->faker->dateTimeBetween('-1 years', 'now');
        $tanggalselesai = $this->faker->optional()->dateTimeBetween('now', '+1 years');

        return [
            'serialnumber' => $this->faker->unique()->numerify('SN-#####'),
            'tanggalmasuk' => $tanggalmasuk ? $tanggalmasuk->format('Y-m-d') : null,
            'tanggalselesai' => $tanggalselesai ? $tanggalselesai->format('Y-m-d') : null,
            'pemilik' => $this->faker->randomElement(['customer', 'stock']),
            'status' => $this->faker->randomElement(['Antrian', 'Validasi', 'Selesai']),
            'pelanggan' => $this->faker->company,
            'servicesdevice_id' => $this->faker->numberBetween(1, 3),
            'pemakaian' => $this->faker->sentence,
            'kerusakan' => $this->faker->sentence,
            'perbaikan' => $this->faker->optional()->sentence,
            'nosparepart' => $this->faker->optional()->numerify('SP-#####'),
            'snkanibal' => $this->faker->optional()->numerify('SK-#####'),
            'teknisi' => $this->faker->name,
            'catatan' => $this->faker->sentence,
        ];
    }
}
