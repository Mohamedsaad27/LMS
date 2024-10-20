<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class SchoolResource extends JsonResource
{

    // public function toArray(Request $request): array
    // {
    //     $lang = $request->header('lang');
    //     return [
    //         'id' => $this->id,
    //         'school_name' => $lang == 'ar' ?  $this->name_ar : $this->name_en,
    //         'established_year' => $this->established_year,
    //         'description' => $lang == 'ar' ? $this->description_ar : $this->description_en,
    //         'email' => $this->email,
    //         'phone' => $this->phone,
    //         'address' => $this->address,
    //         'logo' => $this->logo,
    //         'type' => $this->type,
    //         'organization' => new OrganizationResource($this->whenLoaded('organization')), // Publishing house relation
    //     ];
    // }
}
