<?php

namespace App\Repositories\Contracts;

use App\Models\Statistic;
use Illuminate\Database\Eloquent\Collection;

interface StatisticRepositoryInterface
{
    public function getAll(): Collection;

    public function findById(int $id): Statistic;

    public function upsert(array $data): Statistic;

    public function sync(array $statistics): Collection;

    public function delete(
        Statistic $statistic
    ): bool;
}