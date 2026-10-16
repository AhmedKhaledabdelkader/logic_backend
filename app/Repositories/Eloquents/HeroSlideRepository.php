<?php

namespace App\Repositories\Eloquents;

use App\Models\HeroSlide;

use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\HeroSlideRepositoryInterface;


class HeroSlideRepository implements HeroSlideRepositoryInterface
{
    
    
      public function getAll(): Collection
    {
        return HeroSlide::latest()->get();
    }

    public function findById(int $id): HeroSlide
    {
        return HeroSlide::findOrFail($id);
    }
public function upsert(array $data): HeroSlide
{
    if (isset($data['id'])) {

        HeroSlide::upsert(
            [$data],
            ['id'],
            [
                'title',
                'subtitle',
                'image',
                'updated_at',
            ]
        );

        return HeroSlide::findOrFail($data['id']);
    }

    $heroSlide = HeroSlide::create($data);

    return $heroSlide;
}

    public function delete(HeroSlide $heroSlide): bool
    {
        return $heroSlide->delete();
    }
}
