<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        foreach (RoleEnum::cases() as $roleEnum)
        {
            Role::create([
               'name' => $roleEnum->value
            ]);
        }
    }
}
