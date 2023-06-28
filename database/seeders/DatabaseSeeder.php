<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\RoleEnum;
use App\Models\Travel;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleTableSeeder::class);
        $user = User::factory()->create([
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'test',
        ]);
        $user->assignRole(RoleEnum::SUPER_ADMIN->value);
        Travel::factory()->count(20)->hasTours(10)->create();
    }
}
