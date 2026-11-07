<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkStepResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            // Display number derived from position in the returned list:
            // "01", "02", ... (see WorkStepController::index).
            'number' => str_pad(
                (string) ($this->display_number ?? $this->sort_order),
                2,
                '0',
                STR_PAD_LEFT
            ),
            'title' => $this->title,
            'description' => $this->description,
            'outcome' => $this->outcome,
            'icon' => $this->icon,
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->format('Y-m-d'),
            'updated_at' => $this->updated_at?->format('Y-m-d'),
        ];
    }
}
