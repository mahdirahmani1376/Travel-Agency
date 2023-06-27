<?php

namespace Database\Factories;

use App\Models\Travel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TravelFactory extends Factory
{
    protected $model = Travel::class;

    public function definition(): array
    {
        $numberOfDays = $this->faker->randomNumber();
        $numberOfNights = $numberOfDays - 1;
        return [
            'is_public' => true,
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'number_of_days' => $numberOfDays,
            'number_of_nights' => $numberOfNights,
        ];
    }
}
