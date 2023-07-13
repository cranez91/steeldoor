<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobOpportunityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'company_name' => $this->company_name,
            'location' => $this->location,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'salary_range' => $this->salary_range,
            'skills' => explode(';', $this->skills)
        ];
    }
}
