<?php

namespace Modules\Advertisements\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertisementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Advertisements\Entities\Advertisement::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

