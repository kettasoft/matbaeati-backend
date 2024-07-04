<?php

namespace Modules\Accounts\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VerificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Accounts\Entities\Verification::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

