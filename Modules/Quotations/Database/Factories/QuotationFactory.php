<?php

namespace Modules\Quotations\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Accounts\Entities\PrintingPress;
use Modules\Quotations\Entities\Quotation;

class QuotationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Quotation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'account_id' => PrintingPress::factory()->create()->id,
            'notes' => $this->faker->paragraph(),
            'status' => Quotation::ONHOLD_STATUS
        ];
    }
}

