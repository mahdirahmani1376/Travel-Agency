<?php

namespace Tests\Feature\Commands;

use App\Enums\RoleEnum;
use App\Models\User;
use Database\Seeders\RoleTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CreateUserCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_users_be_created_with_command_line()
    {
        $this->seed(RoleTableSeeder::class);
        $name = 'mahdi rahmani';
        $gmail = 'rahmanimahdi16@gmail.com';
        $password = 'test';
        $command = $this->artisan("create:user");

        $command
            ->expectsQuestion('pleases provide an email address',$gmail)
            ->expectsQuestion('pleases provide a password',$password)
            ->expectsQuestion('pleases provide a name',$name)
            ->expectsChoice('pleases select one or more roles to assign to user',RoleEnum::SUPER_ADMIN->value,RoleEnum::values())
            ->expectsOutput("user with email {$gmail} created successfully")
            ->assertExitCode(0);

    }
}
