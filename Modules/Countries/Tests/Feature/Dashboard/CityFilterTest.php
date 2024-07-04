<?php

namespace Modules\Countries\Tests\Feature\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Countries\Entities\City;
use Modules\Countries\Entities\Country;
use Tests\TestCase;

class CityFilterTest extends TestCase
{


    /** @test */
    public function it_can_filter_cities_by_name()
    {
        $this->actingAsAdmin();

        $this->app->setLocale('ar');

        $country = Country::factory()->create([
            'name:ar' => 'مصر',
        ]);

        City::factory()->create([
            'country_id' => $country->id,
            'name:ar' => 'القاهرة',
        ]);

        City::factory()->create([
            'country_id' => $country->id,
            'name:ar' => 'الاسكندرية',
        ]);

        $this->get(route('dashboard.countries.show', [
            $country,
            'name' => 'الاسكندرية',
        ]))
            ->assertSuccessful()
            ->assertSee(trans('countries::cities.actions.filter'))
            ->assertSee('الاسكندرية')
            ->assertDontSee('القاهرة');
    }
}
