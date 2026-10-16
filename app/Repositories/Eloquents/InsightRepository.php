<?php

namespace App\Repositories\Eloquents;

use App\Models\Insight;
use App\Repositories\Contracts\InsightRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class InsightRepository implements InsightRepositoryInterface
{
    public function getAll(): Collection
    {
        return Insight::latest()->get();
    }

    public function getFeatured(): Collection
    {
        return Insight::where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();
    }

    public function find(int $id): Insight
    {
        return Insight::findOrFail($id);
    }

    public function create(array $data): Insight
    {
        $isFeatured = $data['is_featured'] ?? false;

        if ($isFeatured) {
            $this->ensureFeaturedLimit();
        }

        return Insight::create([
            'title' => $data['title'],
            'image' => $data['image'] ?? null,
            'is_featured' => $isFeatured,
        ]);
    }

    public function update(int $id, array $data): Insight
    {
        $insight = Insight::findOrFail($id);

        $isFeatured = $data['is_featured'] ?? false;

        // Only re-check the cap when this insight is newly being featured —
        // an already-featured insight being edited shouldn't count against itself.
        if ($isFeatured && !$insight->is_featured) {
            $this->ensureFeaturedLimit();
        }

        $insight->update([
            'title' => $data['title'],
            'image' => $data['image'] ?? $insight->image,
            'is_featured' => $isFeatured,
        ]);

        return $insight->fresh();
    }

    public function delete(int $id): bool
    {
        $insight = Insight::findOrFail($id);

        return (bool) $insight->delete();
    }

    private function ensureFeaturedLimit(): void
    {
        $count = Insight::where('is_featured', true)->count();

        if ($count >= 3) {
            abort(422, 'Only 3 insights can appear on the home page.');
        }
    }
}