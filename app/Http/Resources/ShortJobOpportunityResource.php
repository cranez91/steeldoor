<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShortJobOpportunityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'company_name' => $this->company_name,
            'location' => $this->location,
            'title' => $this->title,
            'slug' => $this->slug,
        ];
    }
}
