<?php

namespace Modules\Advertisements\tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Accounts\Entities\Admin;

class AadvertisementApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function it_can_create_aadvertisement()
    {
        $admin = Admin::factory()->create();
    }
}
