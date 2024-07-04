<?php

namespace Modules\Categories\Tests\Feature\Dashboard;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Categories\Entities\Category;

class CategoryFilterTest extends TestCase
{
    /** @test */
    public function it_can_filter_categories_by_name()
    {
        $this->actingAsAdmin();

        $this->app->setLocale('ar');

        Category::factory()->create([
            'name:ar' => 'ملابس',
        ]);

        Category::factory()->create([
            'name:ar' => 'هواتف',
        ]);

        $this->get(route('dashboard.categories.index', [
            'name' => 'ملابس',
        ]))
            ->assertSuccessful()
            ->assertSee(trans('categories::categories.actions.filter'))
            ->assertSee('ملابس')
            ->assertDontSee('هواتف');
    }
}
