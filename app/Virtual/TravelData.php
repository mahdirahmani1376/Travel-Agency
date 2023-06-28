<?php

namespace App\Virtual;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Travel data",
 *      description="travel Data",
 *      type="object",
 *      required={"is_public","name","description","number_of_days"}
 * )
 */
class TravelData
{
    /**
     * @OA\Property(
     *      title="is_public",
     *      description="is_public of the new Travel",
     *      example="true",
     * )
     *
     * @var bool
     */
    public bool $is_public;

    /**
     * @OA\Property(
     *      title="name",
     *      description="name of the new Travel",
     *      example="test",
     * )
     *
     * @var string
     */
    public string $name;

    /**
     * @OA\Property(
     *      title="description",
     *      description="description of the new Travel",
     *      example="test",
     * )
     *
     * @var string
     */
    public string $description;

    /**
     * @OA\Property(
     *      title="number_of_days",
     *      description="number_of_days of the new Travel",
     *      example="1",
     * )
     *
     * @var int
     */
    public int $number_of_days;
}
