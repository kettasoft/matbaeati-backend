<?php

namespace Modules\Categories\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Categories\Entities\Category;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Categories\Entities\Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            // 'parent_id' => Category::inRandomOrder()->first()->id,
            'description' => $this->faker->text,
            'active' => true
        ];
    }
}

