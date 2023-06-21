<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Tour */
class TourResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'travel_id' => $this->travel_id,
            'name' => $this->name,
            'stating_date' => $this->stating_date,
            'ending_date' => $this->ending_date,
            'price' => $this->price,
            'travel' => TravelResource::make($this->whenLoaded('tour'))
        ];
    }
}
