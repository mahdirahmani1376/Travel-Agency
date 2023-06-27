<?php

namespace Tests\Feature\Controllers;

use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\BaseTest;
use Tests\TestCase;

class TravelControllerTest extends BaseTest
{
    use RefreshDatabase;

    /** @test */
    public function can_user_see_public_travels()
    {
        Travel::factory()->create();

        $response = $this->getJson(route('travels.index'));

        $response->assertStatus(200);
    }

    /** @test */
    public function can_user_create_travel()
    {
        $travel = Travel::factory()->make();

        $response = $this->postJson(route('travels.store'),$travel->toArray());

        $response->assertStatus(200);

        $this->assertDatabaseHas('travels',[
           'name' => $travel->name
        ]);

    }

    /** @test */
    public function can_user_update_travel()
    {
        $travel = Travel::factory()->create();

        $data = Travel::factory()->make();

        $response = $this->putJson(route('travels.update',$travel),$data->only(['name','description','is_public','number_of_days']));

        $response->assertStatus(200);
        $this->assertDatabaseHas('travels',[
            'name' => $data->name,
            'description' => $data->description,
        ]);

    }
}
