<?php

namespace App\Virtual;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Login data",
 *      description="login Data",
 *      type="object",
 *      required={"email", "password"}
 * )
 */
class LoginData
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="email of the user",
     *      example="test@example.com",
     * )
     *
     * @var string
     */
    public string $name;

    /**
     * @OA\Property(
     *      title="password",
     *      description="password of the User",
     *      example="test",
     * )
     *
     * @var string
     */
    public string $password;

}
