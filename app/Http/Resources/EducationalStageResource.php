<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationalStageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'school_id' => $this->school_id,
            'school' => new SchoolResource($this->whenLoaded('school')), // School relation
            'grades' => GradeResource::collection($this->whenLoaded('grades')), // Grades relation
        ];
    }
}
