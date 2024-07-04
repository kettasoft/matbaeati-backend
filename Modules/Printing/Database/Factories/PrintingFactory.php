<?php

namespace Modules\Printing\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PrintingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Printing\Entities\Printing::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

