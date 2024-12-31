<?php

namespace App\Http\Resources\ApiV1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResumeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $aboutMe = $this['aboutMe'] ?? [];
        $skill = $this['skill'] ?? [];
        $education = $this['education'] ?? [];
        $experience = $this['experience'] ?? [];

        return [
            'Experience' => $experience,
            'Education' => $education,
            'Skills' => $skill,
            'About Me' => $aboutMe,
            'defaultSection' => 'experience'
        ];

    }
}
