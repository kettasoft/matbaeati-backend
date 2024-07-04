<?php

namespace Modules\Countries\Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Countries\Entities\City;
use Modules\Countries\Entities\Country;
use Tests\TestCase;

class SelectTest extends TestCase
{


    public function test_countries_select2_api()
    {
        Country::factory(5)->create();

        $response = $this->getJson(route('countries.select'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'text', 'image'],
                ],
            ]);

        $this->assertEquals($response->json('data.0.id'), 1);

        $this->assertCount(5, $response->json('data'));

        $response = $this->getJson(route('countries.select', ['selected_id' => 4]))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'text', 'image'],
                ],
            ]);

        $this->assertEquals($response->json('data.0.id'), 4);

        $this->assertCount(5, $response->json('data'));
    }

    public function test_cities_select2_api()
    {
        City::factory(5)->create();

        $this->getJson(route('cities.select'))
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'text', 'image'],
                ],
            ]);
    }
}
