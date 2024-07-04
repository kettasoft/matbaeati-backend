<?php

namespace Modules\Quotations\tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Modules\Quotations\Entities\Quotation;

class QuotationApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     * @test
     */
    public function it_can_display_list_of_quotations()
    {
        $this->actingAsOffice();

        Quotation::factory()->create();

        $response = $this->get(route('quotations.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(3);
        $response->assertJsonStructure([
            'success',
            'data' => [
                '*' => [
                    'id',
                    'account_id',
                    'notes',
                    'status',
                    'created_at',
                    'created_at_format'
                ]
            ],
            'message'
        ]);
    }
}
