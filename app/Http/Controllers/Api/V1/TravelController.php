<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TravelRequest;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TravelController extends Controller
{
    public function index(): JsonResponse
    {
        return Response::json(
            data: TravelResource::collection(
                Travel::where('is_public',true)->paginate()
            )
        );
    }

    public function store(TravelRequest $request): JsonResponse
    {
        $data = $request->validated();
        $travel = Travel::create($data);

        return Response::json(
            data: TravelResource::make(
                $travel
            )
        );
    }
}
