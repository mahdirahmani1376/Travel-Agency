<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TravelRequest;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use OpenApi\Annotations as OA;

class TravelController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/travels",
     *      operationId="getTravelsList",
     *      tags={"Travels"},
     *      summary="Get list of travels",
     *      description="Returns list of travels",
     *      @OA\Response(response=200,description="Successful operation",@OA\JsonContent()),
     *      @OA\Response(response=401,description="Unauthenticated",@OA\JsonContent()),
     *      @OA\Response(response=403,description="Forbidden",@OA\JsonContent())
     * )
     */
    public function index(): JsonResponse
    {
        return Response::json(
            data: TravelResource::collection(
                Travel::where('is_public', true)->paginate()
            )
        );
    }

    /**
     * @OA\Post(
     *      path="/api/travels",operationId="storeTravel",tags={"TravelParts"},description="store new travel request",
     *      @OA\RequestBody(required=true,@OA\JsonContent(ref="#/components/schemas/TravelData")),
     *      @OA\Response(response=200,description="Successful operation",),
     *      @OA\Response(response=401,description="Unauthenticated",@OA\JsonContent()),
     *      @OA\Response(response=403,description="unauthorized"),
     *      security={ {"sanctum": {} }},
     * ),
     */
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

    /**
     * @OA\Put(
     *      path="/api/travels/{travel}/update",operationId="updateTravel",tags={"TravelParts"},description="update delivery part",
     *      @OA\Parameter(name="travel",description="travel_id of the Travel",required=true, in="path",@OA\Schema(type="integer",example=1)),
     *      @OA\RequestBody(required=true,@OA\JsonContent(ref="#/components/schemas/TravelData"),),
     *      @OA\Response(response=200,description="Successful operation",@OA\JsonContent()),
     *      @OA\Response(response=401, description="Unauthenticated"),
     *      @OA\Response(response=403, description="unauthorized"),
     *      security={ {"sanctum": {} }},
     * )
     */
    public function update(Travel $travel, TravelRequest $request): JsonResponse
    {
        $data = $request->validated();
        $travel->update($data);

        return Response::json(
            data: TravelResource::make(
                $travel
            )
        );
    }
}
