<?php

namespace App\Repositories\Eloquents;

use App\Models\Regional;
use App\Repositories\Contracts\RegionalRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class RegionalRepository implements RegionalRepositoryInterface
{
    /**
     * Get the single Regional section.
     */
    public function get(): ?Regional
    {
        return Regional::find(1);
    }

    /**
     * Get Regional ID = 1.
     */
    public function findById(int $id): Regional
    {
        return Regional::findOrFail($id);
    }

    /**
     * Create or update Regional ID = 1.
     */
    public function upsert(array $data): Regional
    {
        $data['id'] = 1;

        Regional::updateOrCreate(
            ['id' => 1],
            [
                'title' => $data['title'] ?? null,
                'paragraph' => $data['paragraph'] ?? null,
                'image' => $data['image'] ?? null,
            ]
        );

        return Regional::findOrFail(1);
    }

    /**
     * Delete Regional ID = 1.
     */
    public function delete(Regional $regional): bool
    {
        return $regional->delete();
    }
}