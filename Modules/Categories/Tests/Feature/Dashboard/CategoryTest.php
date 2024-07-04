<?php

namespace Modules\Categories\Tests\Feature\Dashboard;

use Astrotomic\Translatable\Validation\RuleFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Categories\Entities\Category;

class CategoryTest extends TestCase
{

    /** @test */
    public function it_can_display_list_of_categories()
    {
        $this->actingAsAdmin();

        $category = Category::factory()->create();

        $response = $this->get(route('dashboard.categories.index'));

        $response->assertSuccessful();

        $response->assertSee(e($category->name));
    }

    /** @test */
    public function it_can_display_category_details()
    {
        $this->actingAsAdmin();

        $category = Category::factory()->create();

        $response = $this->get(route('dashboard.categories.show', $category));

        $response->assertSuccessful();

        $response->assertSee(e($category->name));
    }

    /** @test */
    public function it_can_create_categories()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class); // remove if test fails
        $this->actingAsAdmin();

        $this->assertEquals(0, Category::count());

        $response = $this->post(
            route('dashboard.categories.store'),
            RuleFactory::make(
                [
                    '%name%' => 'Clothes',
                    '%description%' => 'Clothes',
                ]
            )
        );
        $response->assertRedirect();
        self::assertEquals(1, Category::count());
    }

    /** @test */
    public function it_can_display_categories_edit_form()
    {
        $this->actingAsAdmin();

        $category = Category::factory()->create();

        $response = $this->get(route('dashboard.categories.edit', [$category]));

        $response->assertSuccessful();

        $response->assertSee(trans('categories::categories.actions.edit'));
    }

    /** @test */
    public function it_can_update_categories()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class); // remove if test fails
        $this->actingAsAdmin();

        $category = Category::factory()->create();

        $response = $this->put(
            route('dashboard.categories.update', [$category]),
            RuleFactory::make(
                [
                    '%name%' => 'Clothes',
                    '%description%' => 'Clothes',
                ]
            )
        );

        $response->assertRedirect();

        $category->refresh();

        $this->assertEquals($category->name, 'Clothes');
    }

    /** @test */
    public function it_can_delete_categories()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class); // remove if test fails
        $this->actingAsAdmin();

        $category = Category::factory()->create();

        $response = $this->delete(route('dashboard.categories.destroy', [$category]));
        $response->assertRedirect();

        $this->assertEquals(Category::count(), 0);
    }
}
