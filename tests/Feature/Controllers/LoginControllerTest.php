<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Database\Seeders\RoleTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleTableSeeder::class);
    }

    /** @test */
    public function can_manager_log_in_successfully()
    {
        $password = 1234;
        $user = User::factory()->create([
            'password' => $password
        ]);

        $data = [
            'email' => $user->email,
            'password' => $password,
        ];
        $response = $this->postJson(route('login'),$data);

        $response->assertJson(function (AssertableJson $json){
            $json
                ->has('token')
                ->etc();
        });
        $response->assertStatus(200);


    }
}
