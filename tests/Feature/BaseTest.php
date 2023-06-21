<?php

namespace Tests\Feature;

use App\Enums\RoleEnum;
use App\Models\User;
use Tests\TestCase;

class BaseTest extends TestCase
{
    protected function setUp(): void
    {
//        $superAdmin = User::factory()->create()->assignRole(RoleEnum::SUPER_ADMIN->value);
//        $admin = User::factory()->create()->assignRole(RoleEnum::ADMIN->value);
//        $editor = User::factory()->create()->assignRole(RoleEnum::EDITOR->value);
        parent::setUp();
    }
}
