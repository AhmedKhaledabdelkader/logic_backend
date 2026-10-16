<?php

namespace App\Repositories\Contracts;

use App\Models\Insight;
use Illuminate\Database\Eloquent\Collection;

interface InsightRepositoryInterface
{
    public function getAll(): Collection;

    public function getFeatured(): Collection;

    public function find(int $id): Insight;

    public function create(array $data): Insight;

    public function update(
        int $id,
        array $data
    ): Insight;

    public function delete(int $id): bool;
}