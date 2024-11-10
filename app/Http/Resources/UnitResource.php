<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $locale = $request->header('lang') ?? 'en';
        return [
            'id' => $this->id,
            'name' => $locale == 'ar' ? $this->name_ar : $this->name_en,
            'description' => $locale == 'ar' ? $this->description_ar : $this->description_en,
            'grade' => new GradeResource($this->whenLoaded('grade')),
            'subject' => $this->subject->name,
        ];
    }
}
