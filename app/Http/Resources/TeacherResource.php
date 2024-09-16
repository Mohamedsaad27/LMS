<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class TeacherResource extends JsonResource
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
            'teacher_name' => $locale == 'ar' ?  $this->user->name_ar : $this->user->name_en,
            'photo' => $this->photo,
            'hire_date' => $this->hire_date,
            'qualification' => $this->qualification,
            'subject_specialization' => $this->subject_specialization,
            'experience_years' => $this->experience_years,
            'status' => $this->status,
            'salary' => $this->salary,
            'date_of_birth' => $this->date_of_birth,
            'additional_data' => new UserResource($this->whenLoaded('user')),
            'school' => new SchoolResource($this->whenLoaded('school')), // school relation
            'subjects' => SubjectResource::collection($this->whenLoaded('subjects')), // subjects relation
        ];
    }
}
