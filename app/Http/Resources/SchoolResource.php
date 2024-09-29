<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class SchoolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = App::getLocale();
        return [
            'id' => $this->id,
            'school_name' => $locale == 'ar' ?  $this->user->name_ar : $this->user->name_en,
            'established_year' => $this->established_year,
            'description' => $this->description,
            'student_count' => $this->student_count,
            'teacher_count' => $this->teacher_count,
            'logo' => $this->logo,
            'type' => $this->type,
            'organization' => new OrganizationResource($this->whenLoaded('organization')), // Publishing house relation
        ];
    }
}
