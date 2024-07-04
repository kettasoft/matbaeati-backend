<?php

namespace Modules\Countries\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Countries\Entities\City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country_id' => \Modules\Countries\Entities\Country::factory()->create()->id,
            'name' => $this->faker->city,
        ];
    }
}

