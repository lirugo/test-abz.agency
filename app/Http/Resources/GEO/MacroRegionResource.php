<?php

namespace App\Http\Resources\GEO;

use Illuminate\Http\Resources\Json\JsonResource;

class MacroRegionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'countries' => CountryResource::collection($this->country)
        ];
    }
}
