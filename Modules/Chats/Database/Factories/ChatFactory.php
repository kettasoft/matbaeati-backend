<?php

namespace Modules\Chats\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Chats\Entities\Chat::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

