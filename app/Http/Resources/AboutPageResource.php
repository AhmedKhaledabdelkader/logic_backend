<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutPageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'hero_title' => $this->hero_title,
            'hero_subtitle' => $this->hero_subtitle,
            'story_title' => $this->story_title,
            'story_paragraph' => $this->story_paragraph,
            'story_image' => $this->story_image,
            'presence' => $this->presence,
            'values' => $this->values,
        ];
    }
}