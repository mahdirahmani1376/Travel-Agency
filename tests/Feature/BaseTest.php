<?php

namespace Tests\Feature;

use App\Enums\RoleEnum;
use App\Models\User;
use Database\Seeders\RoleTableSeeder;
use Tests\TestCase;

class BaseTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleTableSeeder::class);
        $superAdmin = User::factory()->create()->assignRole(RoleEnum::SUPER_ADMIN->value);
        $admin = User::factory()->create()->assignRole(RoleEnum::ADMIN->value);
        $editor = User::factory()->create()->assignRole(RoleEnum::EDITOR->value);
        $this->actingAs($superAdmin);
    }
}
