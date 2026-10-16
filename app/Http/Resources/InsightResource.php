<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InsightResource extends JsonResource
{
    public function toArray(
        Request $request
    ): array {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image,
            'is_featured' => $this->is_featured,

            'created_at' =>
                $this->created_at?->format('Y-m-d'),

            'updated_at' =>
                $this->updated_at?->format('Y-m-d'),
        ];
    }
}