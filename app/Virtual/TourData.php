<?php

namespace App\Virtual;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Tour data",
 *      description="tour Data",
 *      type="object",
 *      required={"name","starting_date","ending_date","price"}
 * )
 */
class TourData
{
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
     *      title="starting_date",
     *      description="starting_date of the new Tour",
     *      example="2023_01_01",
     * )
     *
     * @var string
     */
    public string $starting_date;

    /**
     * @OA\Property(
     *      title="ending_date",
     *      description="nending_date of the new Tour",
     *      example="2023_01_01",
     * )
     *
     * @var string
     */
    public int $ending_date;

    /**
     * @OA\Property(
     *      title="price",
     *      description="price of the new Tour",
     *      example="100",
     * )
     *
     * @var int
     */
    public int $price;
}
