<?php

namespace Modules\Countries\Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Countries\Entities\City;
use Modules\Countries\Entities\Country;
use Tests\TestCase;

class CountryTest extends TestCase
{


    /** @test */
    public function it_can_list_countries()
    {
        $this->actingAsAdmin();

        Country::factory(2)->create();

        $this->getJson(route('countries.index'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'code',
                            'key',
                            'is_default',
                            'currency',
                            'flag',
                        ],
                    ],
                ],
            ]);
    }

    /** @test */
    public function it_can_display_country_with_cities()
    {
        $country = Country::factory()->create();

        City::factory(5)->create(['country_id' => $country->id]);

        $this->getJson(route('countries.show', $country))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'code',
                    'key',
                    'currency',
                    'flag',
//                    'cities' => [
//                        '*' => ['id', 'name'],
//                    ],
                ],
            ]);
    }

    /** @test */
    public function it_can_display_default_country_with_cities()
    {
        $country = Country::factory()->create();

        City::factory(5)->create(['country_id' => $country->id]);

        $this->getJson(route('countries.default'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'code',
                    'key',
                    'currency',
                    'flag',
                    'cities' => [
                        '*' => ['id', 'name'],
                    ],
                ],
            ]);
    }
}
