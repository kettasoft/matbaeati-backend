<?php

namespace Modules\Categories\Tests\Feature\Api;

use Tests\TestCase;
use Modules\Categories\Entities\Category;

class CategoryApiTest extends TestCase
{

    /** @test */
    public function it_can_display_list_of_categories()
    {
        $category = Category::factory()->create([
            'active' => true
        ]);

        $response = $this->get(route('categories.index'));

        $response->assertSuccessful();

        $response->assertSee(e($category->name));
    }

    /** @test */
    public function it_can_display_list_of_categories_details()
    {
        $category = Category::factory()->create([
            'active' => true
        ]);

        $response = $this->get(route('categories.show', $category));

        $response->assertSuccessful();

        $response->assertSee(e($category->name));
    }
}
