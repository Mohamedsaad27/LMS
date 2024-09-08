<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class StudentResource extends JsonResource
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
            'school_id' => $this->school_id,
            'date_of_birth' => $this->date_of_birth,
            'enrollment_date' => $this->enrollment_date,
            'grade' => $this->grade,
            'parent_contact' => $this->parent_contact,
            'photo' => $this->photo,
            'user' => new UserResource($this->whenLoaded('user')), // User relation
            'school' => new SchoolResource($this->whenLoaded('school')), // School relation
        ];
    }
}
