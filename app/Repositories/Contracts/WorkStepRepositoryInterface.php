<?php

namespace App\Repositories\Contracts;

use App\Models\WorkStep;
use Illuminate\Database\Eloquent\Collection;

interface WorkStepRepositoryInterface
{
    public function getAll(bool $onlyActive = false): Collection;

    public function find(int $id): ?WorkStep;

    public function create(array $data): WorkStep;

    public function update(WorkStep $step, array $data): WorkStep;

    /** Deletes the step and closes the gap in the numbering. */
    public function delete(WorkStep $step): bool;

    /** @param int[] $ids Step ids in their new order. */
    public function reorder(array $ids): void;
}
