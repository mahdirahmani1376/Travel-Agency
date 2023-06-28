<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Travel Agency Documentation",
 *      description="",
 *      @OA\Contact(email="rahmanimahdi16@gmail.com"),
 *      @OA\License(name="Apache 2.0",url="http://www.apache.org/licenses/LICENSE-2.0.html")
 * )
 * @OA\Server(url=L5_SWAGGER_CONST_HOST,description="Demo API Server")
 * @OA\Tag(name="Travel Agency",description="API Endpoints of Travel Agency"),
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
