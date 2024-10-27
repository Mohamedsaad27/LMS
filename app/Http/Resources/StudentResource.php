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
        $lang = $request->header('lang');
        return [
            'id' => $this->id,
            'name' => $lang == 'ar' ? ($this->user->name_ar ?? '') : ($this->user->name_en ?? ''),
            'email' => $this->user->email,
            'gender' => $this->user->gender,
            'address' => $this->user->address,
            'phone' => $this->user->phone,
            'school_name' => $lang == 'ar' ? ($this->school->name_ar ?? '') : ($this->school->name_en ?? ''),
            'date_of_birth' => $this->date_of_birth,
            'enrollment_date' => $this->enrollment_date,
            'parent_contact' => $this->parent_contact,
            'photo' => $this->photo,
        ];
    }
}
