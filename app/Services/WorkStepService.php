<?php

namespace App\Services;

use App\Models\WorkStep;
use App\Repositories\Contracts\WorkStepRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class WorkStepService
{
    public function __construct(
        protected WorkStepRepositoryInterface $workStepRepository
    ) {
    }

    public function getAll(bool $onlyActive = false): Collection
    {
        return $this->workStepRepository->getAll($onlyActive);
    }

    public function find(int $id): ?WorkStep
    {
        return $this->workStepRepository->find($id);
    }

    public function create(array $data): WorkStep
    {
        return $this->workStepRepository->create($data);
    }

    public function update(WorkStep $step, array $data): WorkStep
    {
        return $this->workStepRepository->update($step, $data);
    }

    public function delete(WorkStep $step): bool
    {
        return $this->workStepRepository->delete($step);
    }

    public function reorder(array $ids): void
    {
        $this->workStepRepository->reorder($ids);
    }
}
