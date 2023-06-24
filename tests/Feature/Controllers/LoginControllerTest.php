<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Database\Seeders\RoleTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $user = User::factory()->create();

        $data = [
            'email' => $user->email,
            'password' => $user->password,
        ];
        $response = $this->postJson(route('login'),$data);

        $response->assertStatus(200);


    }
}
