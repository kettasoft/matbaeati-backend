<?php

namespace Modules\Countries\Tests\Feature\Dashboard;

use App\Http\Middleware\VerifyCsrfToken;
use Astrotomic\Translatable\Validation\RuleFactory;
use Modules\Countries\Entities\City;
use Modules\Countries\Entities\Country;
use Tests\TestCase;

class CountryTest extends TestCase
{


    /** @test */
    public function it_can_list_countries()
    {
        $this->actingAsAdmin();

        Country::factory()->create(['name' => 'Egypt']);

        $response = $this->get(route('dashboard.countries.index'));

        $response->assertSuccessful();

        $response->assertSee('Egypt');
    }

    /** @test */
    public function it_can_display_country_details()
    {
        $this->actingAsAdmin();

        $country = Country::factory()->create();

        $city = City::factory()->create(['country_id' => $country->id]);

        $response = $this->get(route('dashboard.countries.show', $country));

        $response->assertSuccessful();

        $response->assertSee(e($country->name));
        $response->assertSee(e($city->name));
    }

    /** @test */
    public function it_can_create_a_new_country()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class); // remove if test fails
        $this->actingAsAdmin();

        $this->assertEquals(0, Country::count());

        $response = $this->post(
            route('dashboard.countries.store'),
            RuleFactory::make(
                [
                    '%name%' => 'Egypt',
                    'code' => 'eg',
                    'key' => '+2',
                ]
            )
        );

        $response->assertRedirect();

        $this->assertEquals(1, Country::count());
    }

    /** @test */
    public function it_can_display_country_create_form()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('dashboard.countries.create'));

        $response->assertSuccessful();

        $response->assertSee(trans('countries::countries.actions.create'));
    }

    /** @test */
    public function it_can_display_country_edit_form()
    {
        $this->actingAsAdmin();

        $country = Country::factory()->create();

        $response = $this->get(route('dashboard.countries.edit', $country));

        $response->assertSuccessful();

        $response->assertSee(trans('countries::countries.actions.edit'));
    }

    /** @test */
    public function it_can_update_country()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class); // remove if test fails
        $this->actingAsAdmin();

        $this->assertEquals(0, Country::count());

        $country = Country::factory()->create();

        $response = $this->put(
            route('dashboard.countries.update', $country),
            RuleFactory::make(
                [
                    '%name%' => 'Egypt',
                    'code' => 'eg',
                    'key' => '+2',
                ]
            )
        );

        $country->refresh();

        $response->assertRedirect();

        $this->assertEquals($country->name, 'Egypt');
    }

    /** @test */
    public function it_determine_default_country_automatic_if_not_set_and_can_replace_default_country()
    {
        $this->assertEquals(Country::count(), 0);

        $defaultCountry = Country::factory()->create(['is_default' => false]);

        $this->assertTrue($defaultCountry->is_default);

        $otherCountry = Country::factory()->create(['is_default' => true]);

        $this->assertNotTrue($defaultCountry->refresh()->is_default);

        $this->assertTrue($otherCountry->is_default);
    }

    /** @test */
    public function it_can_delete_country()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class); // remove if test fails
        $this->actingAsAdmin();

        $this->assertEquals(Country::count(), 0);

        $defaultCountry = Country::factory()->create(['is_default' => true]);

        $response = $this->delete(route('dashboard.countries.destroy', $defaultCountry));

        $response->assertForbidden();

        $country = Country::factory()->create();

        $this->assertEquals(Country::count(), 2);

        $response = $this->delete(route('dashboard.countries.destroy', $country));

        $response->assertRedirect();

        $this->assertEquals(Country::count(), 1); // Default
    }
}
