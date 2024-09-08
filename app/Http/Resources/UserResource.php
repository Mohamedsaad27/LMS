<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
        return [
            'id' => $this->id,
            'email' => $this->email,
            'is_verified' => $this->is_verified,
            'user_type' => new UserTypeResource($this->whenLoaded('type')),  // Assuming you have a UserTypeResource
            'gender' => $this->gender,
            'address' => $this->address,
            'phone' => $this->phone,
            'publishing_house' => new PublishingHouseResource($this->whenLoaded('publishing_house')),  // Only load when needed
            'teacher' => new TeacherResource($this->whenLoaded('teacher')),  // Only load when needed
            'student' => new StudentResource($this->whenLoaded('student')),  // Only load when needed
            'school' => new SchoolResource($this->whenLoaded('school')),  // Only load when needed
            'admin' => new AdminResource($this->whenLoaded('admin')),  // Only load when needed

        ];
    }
}
