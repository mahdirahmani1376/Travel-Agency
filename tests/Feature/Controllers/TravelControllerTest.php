<?php

namespace Tests\Feature\Controllers;

use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\BaseTest;
use Tests\TestCase;

class TravelControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_user_see_public_travels()
    {
        Travel::factory()->create();

        $response = $this->getJson(route('travels.index'));

        $response->assertStatus(200);
    }
}
