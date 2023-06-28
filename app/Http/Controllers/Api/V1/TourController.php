<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourIndexDataRequest;
use App\Http\Requests\TourRequest;
use App\Http\Resources\TourResource;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use OpenApi\Annotations as OA;

class TourController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/travels/{travel}/tours",
     *      operationId="getTravelToursList",
     *      tags={"Tours"},
     *      summary="Get list of tours",
     *      description="Returns list of tours",
     *      @OA\Parameter(name="travel",description="slug of the Travel",required=true, in="path",@OA\Schema(type="string",example="test")),
     *      @OA\Response(response=200,description="Successful operation",@OA\JsonContent()),
     *      @OA\Response(response=401,description="Unauthenticated",@OA\JsonContent()),
     *      @OA\Response(response=403,description="Forbidden",@OA\JsonContent()),
     *      security={ {"sanctum": {} }},
     * )
     */
    public function index(Travel $travel, TourIndexDataRequest $request): JsonResponse
    {
        return Response::json(
            data: TourResource::collection(
                $travel->tours()->filter($request)->paginate(config('pagination-config.pagination_count'))
            )
        );
    }

    /**
     * @OA\Post(
     *      path="/api/{travel}/tours",operationId="storePartDelivery",tags={"Tours"},description="store new Tour",
     *      @OA\Parameter(name="travel",description="travel_id of the Travel",required=true, in="path",@OA\Schema(type="integer",example="1")),
     *      @OA\RequestBody(required=true,@OA\JsonContent(ref="#/components/schemas/TourData"),),
     *      @OA\Response(response=200,description="Successful operation",@OA\JsonContent()),
     *      @OA\Response(response=401,description="Unauthenticated",),
     *      @OA\Response(response=403,description="unauthorized"),
     *      security={ {"sanctum": {} }},
     * ),
     */
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
