<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $lang === 'ar' ? $this->name_ar : $this->name_en,
            'email' => $this->email,
            'is_verified' => $this->is_verified,
            'user_type' => $this->user_type,
            'gender' => $this->gender,
            'address' => $this->address,
            'phone' => $this->phone,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
            'token' => $this->token,
        ];
    }
}
