<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class OrganizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('lang');
        return [
            'organization_id' => $this->id,
            'organization_name' => $lang == 'ar' ? $this->name_ar : $this->name_en,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'organization_logo' => $this->logo,
            'established_year' => $this->established_year,
            'organization_description' => $lang == 'ar' ? $this->description_ar : $this->description_en,
        ];
    }
}
