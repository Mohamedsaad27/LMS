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
            'additional_data' => new UserResource($this->whenLoaded('user')), // User relation
            'publishing_house' => new PublishingHouseResource($this->whenLoaded('publishing_house')), // Publishing house relation
            'teachers' => TeacherResource::collection($this->whenLoaded('teachers')), // Teachers relation
            'students' => StudentResource::collection($this->whenLoaded('students')), // Students relation
            'education_stages' => EducationalStageResource::collection($this->whenLoaded('education_stages')), // Education stages relation
        ];
    }
}
