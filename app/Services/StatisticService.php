<?php

namespace App\Services;

use App\Models\Statistic;
use App\Repositories\Contracts\StatisticRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class StatisticService
{
    public function __construct(
        protected StatisticRepositoryInterface $statisticRepository
    ) {
    }

    public function getAll(): Collection
    {
        return $this->statisticRepository->getAll();
    }

    public function getById(int $id): Statistic
    {
        return $this->statisticRepository->findById($id);
    }

    public function upsert(array $data): Statistic
    {
        return $this->statisticRepository->upsert($data);
    }

    public function sync(
        array $statistics
    ): Collection {

        return $this->statisticRepository->sync(
            $statistics
        );
    }

    public function delete(int $id): bool
    {
        $statistic =
            $this->statisticRepository->findById($id);

        return $this->statisticRepository->delete(
            $statistic
        );
    }
}