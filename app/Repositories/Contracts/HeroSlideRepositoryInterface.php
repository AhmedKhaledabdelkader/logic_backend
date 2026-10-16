<?php

namespace App\Repositories\Contracts;

use App\Models\HeroSlide;
use Illuminate\Database\Eloquent\Collection;

interface HeroSlideRepositoryInterface
{
     public function getAll(): Collection;

    public function findById(int $id): HeroSlide;

    public function upsert(array $data): HeroSlide;

    public function delete(HeroSlide $heroSlide): bool;
}
