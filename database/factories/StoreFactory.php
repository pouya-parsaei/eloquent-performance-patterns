<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $longitude = $this->faker->longitude(-180, 180);
        $latitude = $this->faker->latitude(-90, 90);
        return [
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'state' => $this->faker->countryCode,
            'postal' => $this->faker->postcode,
            'location' => DB::raw("ST_SRID(Point($longitude, $latitude), 4326)"),
        ];
    }
}
