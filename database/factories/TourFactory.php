<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TourFactory extends Factory
{
    protected $model = Tour::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'starting_date' => Carbon::now()->addDays(random_int(1,6))->toDateTimeString(),
            'ending_date' => Carbon::now()->addDays(random_int(7,12))->toDateTimeString(),
            'price' => $this->faker->randomFloat(2,1,200),
            'travel_id' => Travel::factory(),
        ];
    }
}
