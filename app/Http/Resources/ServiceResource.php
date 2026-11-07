<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $items = $this->items;

        // Bullets bucketed by group_title, preserving order. Services without
        // sub-sections produce a single group whose title is null.
        $groups = $items
            ->groupBy(fn ($item) => $item->group_title ?? '')
            ->map(fn ($group, $title) => [
                'title' => $title === '' ? null : $title,
                'items' => $group->map(fn ($i) => [
                    'id' => $i->id,
                    'title' => $i->title,
                ])->values(),
            ])
            ->values();

        return [
            'id' => $this->id,
            'code' => $this->code,
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'icon' => $this->icon,
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
            'items' => $items->map(fn ($i) => [
                'id' => $i->id,
                'title' => $i->title,
                'group_title' => $i->group_title,
                'sort_order' => $i->sort_order,
            ])->values(),
            'groups' => $groups,
            'items_count' => $items->count(),
            'created_at' => $this->created_at?->format('Y-m-d'),
            'updated_at' => $this->updated_at?->format('Y-m-d'),
        ];
    }
}
