<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class PublishingHouseResource extends JsonResource
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
          'publishing_house_name' => $locale == 'ar' ? $this->user->name_ar : $this->user->name_en,
          'logo' => $this->logo,
          'established_year' => $this->established_year,
          'description' => $locale == 'ar' ? $this->description_ar : $this->description_en,
          'total_books'  => $this->total_books
        ];
    }
}
