<?php

namespace Modules\Offers\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Offers\Entities\Offer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

