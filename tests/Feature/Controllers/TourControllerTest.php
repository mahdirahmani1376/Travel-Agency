<?php

namespace Tests\Feature\Controllers;

use App\Models\Tour;
use App\Models\Travel;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TourControllerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_user_view_a_tour_by_its_slug()
    {
        $travel = Travel::factory()->create();
        Tour::factory()->for($travel,'travel')->count(20)->create();

        $response = $this->getJson(route('travels-tours.index',$travel->slug));
        $response->assertStatus(200);
        $response->assertJsonCount(config('pagination-config.pagination_count'));

    }

    /** @test */
    public function can_user_filter_tour_results()
    {
        $travel = Travel::factory()->create();
        $now = Carbon::now();
        Tour::factory()->for($travel,'travel')->create([
            'price' => 500,
        ]);
        Tour::factory()->for($travel,'travel')->create([
            'price' => 1000,
            'stating_date' => $now,
            'ending_date' => $now->addDays(1),
        ]);

        Tour::factory()->for($travel,'travel')->create([
            'price' => 1500,
            'stating_date' => $now->addDays(2),
            'ending_date' => $now->addDays(4)
        ]);

        Tour::factory()->for($travel,'travel')->create([
            'price' => 3000,
            'stating_date' => $now->addDays(8),
            'ending_date' => $now->addDays(10),
        ]);
        Tour::factory()->for($travel,'travel')->create([
            'price' => 4000,
            'ending_date' => $now->addDays(3)
        ]);

        $param = [
            'travel' => $travel->slug,
//            'priceFrom' => 1000,
//            'priceTo' => 3900,
//            'dateFrom' => $now->addDays(2)->toDateTimeString(),
//            'dateFrom' => "2023-08-12",
//            'dateTo' => "2023-08-12",
            'sortBy' => 'price',
            'sortOrder' => 'asc'
        ];

        $response = $this->getJson(route('travels-tours.index', $param));
        $response->assertStatus(200);
    }
}
