<?php

namespace App\Repositories\Eloquents;

use App\Models\WorkStep;
use App\Repositories\Contracts\WorkStepRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class WorkStepRepository implements WorkStepRepositoryInterface
{
    public function getAll(bool $onlyActive = false): Collection
    {
        return WorkStep::query()
            ->when($onlyActive, fn ($q) => $q->where('is_active', true))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
    }

    public function find(int $id): ?WorkStep
    {
        return WorkStep::find($id);
    }

    public function create(array $data): WorkStep
    {
        return DB::transaction(function () use ($data) {
            $count = WorkStep::count();

            // Insert at the requested position (1-based), default: the end.
            $position = min(max((int) ($data['sort_order'] ?? $count + 1), 1), $count + 1);

            WorkStep::where('sort_order', '>=', $position)->increment('sort_order');

            $data['sort_order'] = $position;

            return WorkStep::create($data);
        });
    }

    public function update(WorkStep $step, array $data): WorkStep
    {
        return DB::transaction(function () use ($step, $data) {
            $newPosition = $data['sort_order'] ?? null;
            unset($data['sort_order']);

            $step->update($data);

            // Moving a step = reorder the whole list with it at the new place.
            if ($newPosition !== null && (int) $newPosition !== $step->sort_order) {
                $ids = WorkStep::where('id', '!=', $step->id)
                    ->orderBy('sort_order')->orderBy('id')
                    ->pluck('id')->all();

                $index = min(max((int) $newPosition, 1), count($ids) + 1) - 1;
                array_splice($ids, $index, 0, [$step->id]);

                $this->reorder($ids);
            }

            return $step->fresh();
        });
    }

    public function delete(WorkStep $step): bool
    {
        return DB::transaction(function () use ($step) {
            $deleted = (bool) $step->delete();

            $this->reorder(
                WorkStep::orderBy('sort_order')->orderBy('id')->pluck('id')->all()
            );

            return $deleted;
        });
    }

    public function reorder(array $ids): void
    {
        DB::transaction(function () use ($ids) {
            foreach (array_values($ids) as $position => $id) {
                WorkStep::whereKey($id)->update(['sort_order' => $position + 1]);
            }
        });
    }
}
