<?php

namespace App\Http\Resources\ApiV1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
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
            'specialization_name' => $this->specialization,
            'profile_name' => $this->name,
            'bio' => $this->bio,
            'resume_file' => prefixedAssetUrl($this?->resume_file),
            'profile_image' => prefixedAssetUrl($this?->profile_image),
            'social_media' => $this->social_media,
            'statistics' => $this->stats,
        ];
    }
}
