<?php

namespace Modules\Breaking\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BreakingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Breaking\Entities\Breaking::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

