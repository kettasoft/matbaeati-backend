<?php

namespace Modules\Countries\Tests\Feature\Dashboard;

use Modules\Countries\Entities\Country;
use Tests\TestCase;

class CountryFilterTest extends TestCase
{


    /** @test */
    public function it_can_filter_countries_by_name()
    {
        $this->actingAsAdmin();

        $this->app->setLocale('ar');

        Country::factory()->create([
            'name:ar' => 'العراق',
        ]);

        Country::factory()->create([
            'name:ar' => 'مصر',
        ]);

        $this->get(route('dashboard.countries.index', [
            'name' => 'العراق',
        ]))
            ->assertSuccessful()
            ->assertSee(trans('countries::countries.actions.filter'))
            ->assertSee('العراق')
            ->assertDontSee('مصر');
    }

    /** @test */
    public function it_can_filter_countries_by_code()
    {
        $this->actingAsAdmin();

        $this->app->setLocale('ar');

        $iraq = Country::factory()->create(['code' => 'iq']);

        $egypt = Country::factory()->create(['code' => 'eg']);

        $this->get(route('dashboard.countries.index', [
            'code' => 'iq',
        ]))
            ->assertSuccessful()
            ->assertSee(trans('countries::countries.actions.filter'))
            ->assertSee($iraq->name)
            ->assertDontSee($egypt->name);
    }

    /** @test */
    public function it_can_filter_countries_by_key()
    {
        $this->actingAsAdmin();

        $this->app->setLocale('ar');

        $iraq = Country::factory()->create(['key' => '+964']);

        $egypt = Country::factory()->create(['code' => '+20']);

        $this->get(route('dashboard.countries.index', [
            'key' => '+964',
        ]))
            ->assertSuccessful()
            ->assertSee(trans('countries::countries.actions.filter'))
            ->assertSee($iraq->name)
            ->assertDontSee($egypt->name);
    }
}
