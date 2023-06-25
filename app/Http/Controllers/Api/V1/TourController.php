<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourIndexDataRequest;
use App\Http\Requests\TourRequest;
use App\Http\Resources\TourResource;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class TourController extends Controller
{
    public function index(Travel $travel, TourIndexDataRequest $request): JsonResponse
    {
        return Response::json(
            data: TourResource::collection(
                $travel->tours()->filter($request)->paginate(config('pagination-config.pagination_count'))
            )
        );
    }

    public function store(Travel $travel, TourRequest $request)
    {
        $tour = $travel->tours()->create($request->validated());
        return Response::json(
            data: TourResource::make(
                $tour
            )
        );
    }
}
